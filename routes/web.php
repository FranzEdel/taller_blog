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
    Route::resource('/posts', PostController::class)->names('admin.posts');
    //Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/list', [PostController::class, 'getPosts'])->name('admin.posts.list');

    //Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('admin.posts.show');

    //Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    //Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');

    //Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    //Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');

    //Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    
   
    // Tag
    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::get('/tags/list', [TagController::class, 'getTags'])->name('admin.tags.list');
      
    Route::get('/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('admin.tags.store');
   
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/tags/{id}', [TagController::class, 'update'])->name('admin.tags.update');

    Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

    // Category
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    //Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/list', [CategoryController::class, 'getCategories'])->name('admin.categories.list');

   // Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');
      
    //Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    //Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
   
    //Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    //Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

    //Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/list', [UserController::class, 'getUsers'])->name('admin.users.list');

    Route::get('/users/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
      
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
   
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/list', [RoleController::class, 'getRoles'])->name('admin.roles.list');

    Route::get('/roles/show/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
      
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
   
    Route::get('/roles/{user}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');

    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
