<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $content = Content::all();

        if ($request->keyword) {
            $content->where(function ($query) use ($request) {
                $query->where('title', 'like', '%', $request->keyword, '%');
            });
        }

        return $content;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Check if image file was uploaded
        if ($request->hasFile('image')) {
            // Store the image publicly and get the path
            $validated['image'] = $request->file('image')->storePublicly('images', 'public');
        }

        // Create the content record
        $content = Content::create($validated);

        // Return the content object
        return $content;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Content::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContentRequest $request, string $id)
    {
        $validated = $request->validated();

        $content = Content::FindOrFail($id);

        $content->update($validated);

        return $content;
    }

    /**
     * Update the email of the specified resource in storage.
     */
    public function points(ContentRequest $request, string $id)
    {
        $content = Content::findOrFail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();

        $content->points =  $validated['points'];

        $content->save();

        return $content;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content = Content::FindOrFail($id);
        $content->delete();
        return $content;
    }
}
