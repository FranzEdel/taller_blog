<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Admin\PostController;
/*
FRONTEND
*/

Route::redirect('/', '/blog');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{post}', [PageController::class, 'show'])->name('show');


/*
BACKEND - ADMINISTRACION
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/list', [PostController::class, 'getPosts'])->name('admin.posts.list');
   
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('admin.posts.show');
   
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
   
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
});








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
