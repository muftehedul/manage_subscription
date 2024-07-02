<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebsiteController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return "hello world";
});

Route::post('/posts', [PostController::class, 'store']);
Route::post('subscriptions', [SubscriptionController::class, 'store']);

Route::post('websites', [WebsiteController::class, 'store']);
