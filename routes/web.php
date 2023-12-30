<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\AdminUser;
use App\Http\Middleware\MustbeAuthUser;
use App\Http\Middleware\MustbeGuestUser;
use App\Mail\SubscriberMail;
use App\Models\Blog;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware([ AdminUser::class])->group(function (){
Route::get("/admin", [AdminController::class,"index"])->name("admin.index");
Route::post("/admin/{blog}/delete", [AdminController::class,"delete"])->name("blog.delete");
Route::get("/admin/blogs", [AdminController::class,"show"])->name("");
Route::get("/admin/{blog}/edit", [AdminController::class,"edit"]);
Route::put("/admin/{blog}/update", [AdminController::class,"update"]);
Route::post("/admin/blogs/create", [AdminController::class,"create"]);
});

Route::middleware([ MustBeAuthUser::class])->group(function () {
    Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');
    Route::post('/logout', [LogoutController::class,'destroy']);
    Route::post('/blogs/{blog:slug}/comments', [CommentController::class,'store']);
    Route::post('/blogs/{blog:slug}/handle-subscription', [SubscriptionController::class,'toggle']);
    Route::post('/comments/{comment}', [CommentController::class,'delete']);
    Route::post('/comments/{comment}/edit', [CommentController::class,'edit']);
    Route::post('/comments/{comment}/update', [CommentController::class,'update']);

});
Route::middleware([ MustbeGuestUser::class])->group(function () {
    Route::get('/login', [LoginController::class,'create']);
Route::post('/login', [LoginController::class,'store']);
Route::get('/register', [RegisterController::class,'create']);
Route::post('/register', [RegisterController::class,'store']);
});
Route::get('/', [BlogController::class, 'index']);




