<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('posts.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'published';

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Article created');
    }

    public function edit(Post $post)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
    abort_unless(auth()->user()->isAdmin(), 403);

    $validated = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('posts', 'public');
    }

    $post->update($validated);

    return redirect()->route('posts.index')->with('success', 'Article updated');
    }

    public function destroy(Post $post)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if ($post->image) {
        Storage::disk('public')->delete($post->image);
            }


        $post->delete();
        return back()->with('success', 'Article deleted');
    }
}
