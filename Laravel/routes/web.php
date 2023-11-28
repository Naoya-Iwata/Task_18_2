<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; /* 自分で追加してる */
use App\Http\Controllers\PostsController;

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

Route::get('/', [PostsController::class, 'index'])->name('index');

Route::get('index', [PostsController::class, 'index'])->name('index');

// あいまい検索でpostデータを受け取ったときのルート
Route::post('index', [PostsController::class, 'search'])->name('search.index');

Auth::routes();

// Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('create-form', [PostsController::class, 'createForm'])->name('createForm');

Route::post('post/create', [PostsController::class, 'create']);

Route::get('post/{id}/update-form', [PostsController::class, 'updateForm'])->name('updateForm');

Route::post('post/update', [PostsController::class, 'update']);

Route::get('post/{id}/{name}/delete', [PostsController::class, 'delete']);

// 画像と一緒に投稿するルート
Route::post('post/store', [PostsController::class, 'store'])->name('posts.store');

// Route::get('public/images/{path}', [PostsController::class, 'imgShow'])->name('imgShow');
