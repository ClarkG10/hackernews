<?php

namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::FindOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {

        $user = User::findOrFail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();

        $user->name =  $validated['name'];

        $user->save();

        return $user;
    }

    /**
     * Update the email of the specified resource in storage.
     */
    public function email(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();

        $user->email =  $validated['email'];

        $user->save();

        return $user;
    }

    /**
     * Update the password of the specified resource in storage.
     */
    public function password(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();

        $user->password = Hash::make($validated['password']);

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);

        $user->delete();

        return $user;
    }

    public function showProfile(Request $request)
    {
        return $request->user();
    }
}
