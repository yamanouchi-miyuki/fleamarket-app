<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestRegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        return response()->noContent();
    }
}
