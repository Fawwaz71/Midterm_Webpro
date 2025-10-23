<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::query()->with('user','category')
                    ->where('user_id', Auth::id());

        if($request->search){
            $query->where(function($q) use ($request) {
                $q->where('title','like','%'.$request->search.'%')
                  ->orWhere('content','like','%'.$request->search.'%');
            });
        }

        if($request->category){
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest()->get();
        $categories = Category::all();

        return view('posts.index', compact('posts','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'category_id'=>'nullable|exists:categories,id',
            'new_category'=>'nullable|string|max:255'
        ]);

        if($request->new_category){
            $category = Category::firstOrCreate(['name'=>$request->new_category]);
            $categoryId = $category->id;
        } else {
            $categoryId = $request->category_id;
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $categoryId,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string',
            'category_id'=>'nullable|exists:categories,id',
            'new_category'=>'nullable|string|max:255'
        ]);

        if($request->new_category){
            $category = Category::firstOrCreate(['name'=>$request->new_category]);
            $request->merge(['category_id' => $category->id]);
        }

        $post->update($request->only(['title','content','category_id']));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if(Auth::id() != $post->user_id){
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
