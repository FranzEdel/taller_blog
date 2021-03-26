<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Admin\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/blog');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/list', [PostController::class, 'getPosts'])->name('admin.posts.list');
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
});








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/blog', [PageController::class, 'blog'])->name('blog');


Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
