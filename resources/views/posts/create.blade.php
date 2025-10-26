@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Create New Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3" name="content">{!! old('content') !!}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option @selected(old('status', 'Draft'))>Draft</option>
                    <option @selected(old('status', 'Published'))>Published</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="source" class="form-label">Source</label>
                <select class="form-select" id="source" name="source">
                    <option @selected(old('source', 'Internal'))>Internal</option>
                    <option @selected(old('source', 'JSON Placeholder'))>JSON Placeholder</option>
                    <option @selected(old('source', 'Fake Store API'))>Fake Store API</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="external_id" class="form-label">External ID</label>
                <input type="text" class="form-control" id="external_id" name="external_id" required
                       value="{{ old('external_id') }}">
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary me-1">
                    Save
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
