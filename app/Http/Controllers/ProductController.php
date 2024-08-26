<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'manufacturer' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        Product::create($validated);

        return redirect()->route('storeProductPage')->with('success', 'Продукт успешно создан!');
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::query();

        if ($request->filled('category')) {
            if ($request->category == 'none') {
                $query->whereNull('category_id');
            } else {
                $query->where('category_id', $request->category);
            }
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {   $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $product->update($validated);

        return redirect()->route('products')->with('success', 'Продукт успешно обновлён.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products')->with('success', 'Продукт успешно удалён.');
    }
}
