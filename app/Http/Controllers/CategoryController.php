<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::latest()->get();
        return view('admin.products.categories', compact('categories'));
    }

    public function get_add_category()
    {
        return view('admin.products.add_category');
    }

    public function post_add_category(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:categories',
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        Category::create($validated);

        return redirect()->route('list_categories');
    }

    public function get_update_category($id)
    {
        $category = Category::find($id);
        return view("admin/update_category", compact('category'));
    }

    public function post_update_category($id, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:categories,title,'.$id,
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('list_categories')->with('success', [
            'message' => "Category was updated successfully",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('list_categories')->with('success', [
            'message' =>"Category deleted successfully!",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
