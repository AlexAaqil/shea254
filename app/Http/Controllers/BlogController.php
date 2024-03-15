<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:blogs',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog = new Blog;

        $blog->title = $validated['title'];
        $blog->slug = Str::slug($validated['title']);
        $blog->content = $validated['content'];

        $blog->save();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = $blog->id . '_' . Str::slug($blog->title) . '.' . $extension;
            $image->storeAs('public/blog-thumbnails', $filename);

            $blog->image = $filename;
            $blog->save();
        }

        return redirect()->route('blogs.index')->with('success', [
            'message' => 'Blog has been added.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blog_details', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs,title,'.$blog->id,
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = $blog->id . '_' . Str::slug($blog->title) . '.' . $extension;
            $image->storeAs('public/blog-thumbnails', $filename);

            // Delete the previous image if it exists
            if ($blog->image) {
                Storage::delete('public/blog-thumbnails/' . $blog->image);
            }

            $blog->image = $filename;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', [
            'message' => 'Blogs has been updated.',
            'duration' => $this->alert_message_duration
        ]);
    }

    public function destroy(Blog $blog)
    {
        // Delete the blog's image if it exists
        if ($blog->image) {
            Storage::delete('public/blog-thumbnails/' . $blog->image);
        }

        // Delete the blog
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', [
            'message' => 'Blog has been deleted.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function users_blogs(Blog $blog)
    {
        $blogs = Blog::latest()->paginate(6);
        return view('blogs', compact('blogs'));
    }
}
