<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;

class BlogManagementController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::all();
        $query = Blog::with('category', 'user')->orderByDesc('id');
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        $blogs = $query->get();
        return view('backend.admin-blog.index', compact('blogs', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'active' => 'boolean',
        ]);
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'active' => $request->active ?? 0,
            'published_at' => now(),
        ]);
        return redirect()->route('admin.blog.index')->with('success', 'Blog created!');
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'active' => 'boolean',
        ]);
        $blog->update($request->all());
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted!');
    }
}