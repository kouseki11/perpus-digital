<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookAdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/books', [BookAdminController::class, 'index'])->name('admin.books.index');
Route::get('/admin/books/create', [BookAdminController::class, 'create'])->name('admin.books.create');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');

Route::get('/users/export/', [UserController::class, 'export'])->name('users.export');
Route::get('/categories/export/', [CategoryController::class, 'export'])->name('categories.export');
Route::get('/books/export/', [BookAdminController::class, 'export'])->name('books.export');

Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::post('/admin/books', [BookAdminController::class, 'store'])->name('admin.books.store');
Route::post('/loans/{book}', [LoanController::class, 'store'])->name('loans.store');
Route::post('/collections/{book}', [CollectionController::class, 'store'])->name('collections.store');
Route::post('/reviews/{book}', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::put('/loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
Route::get('/admin/books/{book}/edit', [BookAdminController::class, 'edit'])->name('admin.books.edit');
Route::put('/admin/books/{book}', [BookAdminController::class, 'update'])->name('admin.books.update');

Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

require __DIR__.'/auth.php';
