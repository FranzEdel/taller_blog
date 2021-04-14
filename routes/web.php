<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
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
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/list', [PostController::class, 'getPosts'])->name('admin.posts.list');
   
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('admin.posts.show');
   
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
   
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');

    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
   
    // Tag
    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::get('/tags/list', [TagController::class, 'getTags'])->name('admin.tags.list');
      
    Route::get('/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('admin.tags.store');
   
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/tags/{id}', [TagController::class, 'update'])->name('admin.tags.update');

    Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/list', [CategoryController::class, 'getCategories'])->name('admin.categories.list');

    Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');
      
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
   
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
