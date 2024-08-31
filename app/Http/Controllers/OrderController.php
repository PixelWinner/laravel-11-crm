<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with(['orderItems.product' => function($query) {
            $query->withTrashed();
        }])->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function allOrders(Request $request)
    {
        $query = Order::with(['orderItems.product', 'user']);

        if ($request->filled('user_email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->user_email . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->appends($request->query());

        return view('orders.all', compact('orders'));
    }

    public function store()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::transaction(function () use ($cartItems, $total) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => Order::STATUS_NEW,
                'total' => $total,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            Auth::user()->cartItems()->delete();
        });

        return redirect()->route('orders')->with('success', 'Заказ оформлен.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::statuses())),
        ]);

        DB::transaction(function () use ($request, $order) {
            $previousStatus = $order->status;

            $order->status = $request->status;
            $order->save();


            if ($previousStatus !== 'cancelled' && $order->status === 'cancelled') {
                foreach ($order->orderItems as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }

            if ($previousStatus === 'cancelled' && in_array($order->status, ['processing', 'completed'])) {
                foreach ($order->orderItems as $item) {
                    if ($item->product && $item->product->stock >= $item->quantity) {
                        $item->product->decrement('stock', $item->quantity);
                    } else {
                        throw new \Exception('Недостаточно товара на складе для заказа #' . $order->id);
                    }
                }
            }

            if (in_array($previousStatus, ['processing', 'completed']) && $order->status === 'new') {
                foreach ($order->orderItems as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Статус заказа обновлён.');
    }


}
