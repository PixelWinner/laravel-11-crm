<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->pluck('total', 'status');

        $ordersByMonth = Order::select(DB::raw('EXTRACT(MONTH FROM created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();


        $months = array_fill(1, 12, 0);
        foreach ($ordersByMonth as $month => $total) {
            $months[(int)$month] = $total;
        }

        $availableYears = Order::select(DB::raw('DISTINCT EXTRACT(YEAR FROM created_at) as year'))
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return view('statistics.index', compact('ordersByStatus', 'months', 'year', 'availableYears'));
    }
}
