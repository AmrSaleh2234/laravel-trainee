<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;


Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {





    Route::post('/register', [UserController::class, 'register'])->middleware("permission:create user");
    Route::get('/bookings', [BookingController::class, 'myBookings']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::get('/users/{id}/posts', [UserController::class, 'getUserPosts']);




    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::get('/posts/{id}/comments', [PostController::class, 'comments']);

    Route::delete('/posts/{id}/tags', [postController::class, 'detachTag']);


    Route::get('/comments', [CommentController::class, 'index']);
    Route::get('/comments/{id}', [CommentController::class, 'show']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
    Route::patch('/comments/{id}', [CommentController::class, 'update']);



    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/role/{id}', [RoleController::class, 'show']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::delete('/role', [RoleController::class, 'destroy']);
    Route::patch('/rolle', [RoleController::class, 'update']);
    Route::post('/role/assign-role-to-user', [RoleController::class, "assignRolleToUser"]);





    Route::post('/tag', [TagController::class, 'store']);
    Route::get('/tag', [TagController::class, 'index']);

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/parent', [CategoryController::class, 'parent']);
    Route::get('/categories/{id}/ancestors', [CategoryController::class, 'ancestors']);
    Route::get('/categories/{id}/ancestors-query', [CategoryController::class, 'ancestorsQuery']);
    Route::get('/categories/{id}/hierarchy', [CategoryController::class, 'hierarchy']);
    Route::get('/categories/{id}/descendants', [CategoryController::class, 'descendants']);
    Route::get('/categories/{id}/descendants-query', [CategoryController::class, 'descendantsQuery']);
});
