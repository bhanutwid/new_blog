<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/posts', [PostController::class, 'getAllPost']);
Route::post('/posts', [PostController::class, 'createPost']);
Route::get('/posts/{id}', [PostController::class, 'getPostById']);
Route::put('/posts/{id}', [PostController::class, 'updatePostById']);
Route::delete('/posts/{id}', [PostController::class, 'deletePostById']);
