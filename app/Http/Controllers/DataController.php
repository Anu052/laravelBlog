<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function index()
    {
        $posts = BlogPost::paginate(3);
        $categories = Category::all();
        $data = [
            'posts' => $posts,
            'categories' => $categories,
        ];
        return view('main', $data);
    }
}
