<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified information of the token bearer resource.
     */
    public function show(Request $request)
    {
        return $request->user();
    }
}
