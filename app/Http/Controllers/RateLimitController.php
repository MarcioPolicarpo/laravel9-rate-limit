<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitController extends Controller
{
    public function clearLimit(Request $request)
    {
        RateLimiter::clear('education'.$request->ip());

        return response(['message' => 'Attempts cleared for '.$request->ip()], 200);
    }
}
