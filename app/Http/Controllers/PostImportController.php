<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostImporter;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;

class PostImportController extends Controller
{
    public function store(Request $request)
    {
        $driver = match ($request->import_from) {
            'JSON Placeholder' => PostImporter::JSON_PLACEHOLDER,
            'Fake Store API' => PostImporter::FAKE_STORE_API,
            default => throw new \InvalidArgumentException($request->import_from.' driver is not supported.')
        };

        try {
            $imported = app()->make(PostImporter::class)
                             ->driver($driver)
                             ->import();
        } catch (ConnectionException|RequestException $e) {
            return to_route('posts.index')->withDanger('Failed to import! API endpoint unresponsive.');
        } catch (\InvalidArgumentException $e) {
            return to_route('posts.index')->withDanger($e->getMessage());
        }

        Post::create(
            array_merge(
                ['user_id' => auth()->id() ?? 0],
                $imported->toArray()
            )
        );

        return to_route('posts.index')->withSuccess('Imported!');
    }
}
