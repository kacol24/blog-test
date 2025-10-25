<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

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
                ['user_id' => auth()->id() ?? 0],
                $validated
            )
        );

        return to_route('posts.index')->withSuccess('Success save post!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => 'required',
            'content'     => '',
            'status'      => '',
            'source'      => '',
            'external_id' => '',
        ]);

        $post->update($validated);

        return to_route('posts.index')->withSuccess('Successfully updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('posts.index')->withSuccess('Deleted!');
    }
}
