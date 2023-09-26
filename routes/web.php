<?php

use App\Actions\BlogReader;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function (BlogReader $reader) {
    $blog = $reader->handle();

    return Inertia::render('Welcome', [
        'blog' => $blog->sortByDesc('date')->values()->all()
    ]);
});

Route::feeds();

Route::get('/blog/{slug}', function (BlogReader $reader, $slug) {
    $blog = $reader->handle();

    $post = $blog->firstWhere('slug', $slug);

    return Inertia::render('Blog/Post', [
        'post' => $post
    ]);
})->name('blog.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
