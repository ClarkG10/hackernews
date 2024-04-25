<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $comment = Comment::create($validated);

        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Comment::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        $validated = $request->validated();

        $comment = Comment::FindOrFail($id);

        $comment->update($validated);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::FindOrFail($id);
        $comment->delete();
        return $comment;
    }
}
