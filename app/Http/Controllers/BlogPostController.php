<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = BlogPost::where('user_id', $user->id)->paginate(3);
        $categories = Category::all();
        $data = [
            'posts' => $posts,
            'categories' => $categories,
        ];
        return view('posts.index', $data);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user->blogPosts()->create($validatedData);

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $post = $user->blogPosts()->findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = $user->blogPosts()->findOrFail($id);
        $post->update($validatedData);

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $user->blogPosts()->findOrFail($id)->delete();
        return redirect()->route('posts.index');
    }
}
