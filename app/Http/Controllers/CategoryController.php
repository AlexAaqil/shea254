<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.products.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.products.add_category');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:categories',
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', [
            'message' => 'Category has been added.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function edit(Category $category)
    {
        return view("admin.products.update_category", compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:120|unique:categories,title,' . $category->id,
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', [
            'message' => "Category has been updated successfully.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', [
            'message' =>"Category has been deleted successfully.",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
