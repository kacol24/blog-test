@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('posts.import') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Import</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="import_from">Import From</label>
                                    <select class="form-select" id="import_from" name="import_from">
                                        <option>JSON Placeholder</option>
                                        <option>Fake Store API</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary ms-1">
                Create Post
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Source</th>
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        {{ $post->id }}
                    </td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        {{ $post->source }}
                    </td>
                    <td>
                        {{ optional($post->author)->name }}
                    </td>
                    <td>
                        {{ $post->created_at->toDateString() }}
                    </td>
                    <td>
                        {{ $post->updated_at->diffForHumans() }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('posts.edit', $post) }}" class="me-1">
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="#" class="text-danger" onclick="this.closest('form').submit()">
                                    Delete
                                </a>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $posts->links() !!}
    </div>
@endsection
