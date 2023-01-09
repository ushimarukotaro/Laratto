<?php

use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;

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

Route::get('/test', function () {
    return view('test');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [TopController::class, 'top'])->name('top');
// マイページ
Route::get('/user/{id}/index', [PostController::class, 'index'])
    ->name('user.index');
// 新規投稿
Route::get('/post/create', [PostController::class, 'create'])
    ->name('post.create');
// 投稿登録処理
Route::post('/post/store', [PostController::class, 'store'])
    ->name('post.store');
