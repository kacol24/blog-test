<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
                     ->mine()
                     ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required',
            'content'     => '',
            'status'      => '',
            'source'      => '',
            'external_id' => '',
        ]);

        Post::create(
            array_merge(
                ['user_id' => auth()->id()],
                $validated
            )
        );

        return to_route('posts.index')->withSuccess('Post created successfully!');
    }

    public function edit(Post $post)
    {
        \Gate::authorize('view', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        \Gate::authorize('update', $post);

        $validated = $request->validate([
            'title'       => 'required',
            'content'     => '',
            'status'      => '',
            'source'      => '',
            'external_id' => '',
        ]);

        $post->update($validated);

        return to_route('posts.index')->withSuccess('Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        \Gate::authorize('delete', $post);

        $post->delete();

        return to_route('posts.index')->withSuccess('Post deleted successfully!');
    }
}
