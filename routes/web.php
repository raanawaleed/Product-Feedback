<?php

use App\Http\Controllers\Admin\FeedbackAdminController;
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

    Route::get('/feedback/search', [FeedbackController::class,'search'])->name('feedback.search');

});

Route::get('/admin', function () {
    return redirect()->route('admin.feedback.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    //  admin routes here
    Route::get('/admin/feedback', [FeedbackAdminController::class, 'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/{id}/edit', [FeedbackAdminController::class, 'edit'])->name('admin.feedback.edit');
    Route::patch('/admin/feedback/{id}', [FeedbackAdminController::class, 'update'])->name('admin.feedback.update');
    Route::delete('/admin/feedback/{id}', [FeedbackAdminController::class, 'destroy'])->name('admin.feedback.destroy');
});
