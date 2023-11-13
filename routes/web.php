<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserProfileController;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Your protected routes here
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/comments/create/{id}', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/get-comments/{id}', [CommentController::class, 'getComments'])->name('comments.create');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});
