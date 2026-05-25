<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('/reports');
});

Route::resource('reports', ReportController::class)
    ->middleware(['auth', 'approved']);
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/pending-users',
        [AdminController::class, 'pendingUsers']);

    Route::post('/admin/approve/{id}',
        [AdminController::class, 'approve']);

});    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';