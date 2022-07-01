<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CustomRateLimit;
use App\Http\Controllers\RateLimitController;

Route::middleware([CustomRateLimit::class])->get('/rate-limit', function() {
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('-0300'));
    return $date->format('Y-m-d H:i:s');
});

Route::post('/rate-limit/clear', [RateLimitController::class, 'clearLimit']);
