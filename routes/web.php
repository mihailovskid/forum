<?php

use App\Http\Controllers\ApproveController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('', [DiscussionController::class, 'index'])->name('index');

Route::group(['prefix' => 'discussions', 'as' => 'discussions.'], function () {
    Route::get('', [DiscussionController::class, 'index'])->name('index');

    Route::get('create', [DiscussionController::class, 'create'])->name('create')->middleware('authenticated_only');
    Route::post('', [DiscussionController::class, 'store'])->name('store')->middleware('authenticated_only');

    Route::get('{discussion}/edit', [DiscussionController::class, 'edit'])->name('edit')->middleware('authenticated_only');
    Route::patch('{discussion}', [DiscussionController::class, 'update'])->name('update')->middleware('authenticated_only');

    Route::get('{discussion}', [DiscussionController::class, 'show'])->name('show');

    Route::post('{discussion}/approve', [DiscussionController::class, 'approve'])->name('approve')->middleware('authenticated_only');
    Route::delete('{discussion}', [DiscussionController::class, 'destroy'])->name('destroy')->middleware('authenticated_only');

    Route::group(['prefix' => '{discussion}/comments', 'as' => 'comments.', 'middleware' => ['authenticated_only']], function () {
        Route::get('create', [CommentController::class, 'create'])->name('create');
        Route::post('', [CommentController::class, 'store'])->name('store');

        Route::get('{comment}/edit', [CommentController::class, 'edit'])->name('edit');
        Route::patch('{comment}', [CommentController::class, 'update'])->name('update');

        Route::delete('{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
});
