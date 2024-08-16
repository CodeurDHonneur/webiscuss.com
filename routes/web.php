<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::post('/user/block/{id}', [UserController::class, 'blockUser'])->name('user.block');
    Route::post('/user/unblock/{id}', [UserController::class, 'unblockUser'])->name('user.unblock');

    Route::post('/user{user}', function(\App\Models\User $user) {
        return "Vous voulez voir vos conversations avec {$user->name}";
    })->name('chat.user');


    Route::post('/user{group}', function(\App\Models\Group $group) {
        return "Vous voulez voir vos conversations dans le groupe {$group->name}";
    })->name('chat.group');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
