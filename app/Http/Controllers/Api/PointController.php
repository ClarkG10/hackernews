<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PointRequest;
use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Point::all();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(PointRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $Points = Point::create($validated);

        return $Points;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Point::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PointRequest $request, string $id)
    {
        $validated = $request->validated();

        $Points = Point::FindOrFail($id);

        $Points->update($validated);

        return $Points;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Points = Point::FindOrFail($id);
        $Points->delete();
        return $Points;
    }
}
