<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

/*
FRONTEND
*/
Route::redirect('/', '/blog');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{post}', [PageController::class, 'show'])->name('show');
Route::get('/categoria/{slug}', [PageController::class, 'category'])->name('category');
Route::get('/etiqueta/{slug}', [PageController::class, 'tag'])->name('tag');

/*
BACKEND - ADMINISTRACION
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Post
    Route::get('/posts/list', [PostController::class, 'getPosts'])->name('admin.posts.list');
    Route::resource('/posts', PostController::class)->names('admin.posts');
   
    // Tag
    Route::get('/tags/list', [TagController::class, 'getTags'])->name('admin.tags.list');
    Route::resource('/tags', TagController::class)->except('show')->names('admin.tags');

    // Category
    Route::get('/categories/list', [CategoryController::class, 'getCategories'])->name('admin.categories.list');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');

    // User
    Route::get('/users/list', [UserController::class, 'getUsers'])->name('admin.users.list');
    Route::resource('/users', UserController::class)->names('admin.users');

    // Roles
    Route::get('/roles/list', [RoleController::class, 'getRoles'])->name('admin.roles.list');
    Route::resource('/roles', UserController::class)->names('admin.roles');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
