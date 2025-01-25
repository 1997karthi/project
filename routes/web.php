<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('add-blog', function () {
    return view('blog.add');
});
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('blog/{id}', [IndexController::class, 'blogIndex'])->name('blogindex');
Route::post('comments', [IndexController::class, 'store'])->name('comments.store');
Route::post('add-blog', [IndexController::class, 'createBlog'])->name('createBlog');
Route::get('list-blog', [IndexController::class, 'blogView'])->name('blog-view');
Route::get('blog-delete', [IndexController::class, 'blogDelete'])->name('blog-delete');
Route::get('edit-blog/{id}', [IndexController::class, 'blogEdit'])->name('blog-edit');
Route::post('manual-add', [IndexController::class, 'manualAdd'])->name('manual-add');
Route::post('csv-import', [IndexController::class, 'csvImport'])->name('csv-add');
Route::post('blog-edit-save', [IndexController::class, 'editSave'])->name('manual-edit');
