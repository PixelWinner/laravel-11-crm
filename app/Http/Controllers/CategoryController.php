<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::create($validated);

        return redirect()->route('categories')->with('success', 'Категория успешно добавлена.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Категория успешно удалена.');
    }
}
