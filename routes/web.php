<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    $stats = [
        'reports' => \App\Models\Report::count(),
        'endangered' => \App\Models\Report::where('status', 'Endangered')->count(),
        'conservationists' => \App\Models\User::count(),
        'regions' => \App\Models\Report::distinct('location')->count(),
    ];
    return view('welcome', compact('stats'));
});

use App\Http\Controllers\ExploreController;

// Public Explorer Routes
Route::get('/explore', [ExploreController::class, 'index']);
Route::get('/explore/{id}', [ExploreController::class, 'show']);

Route::resource('reports', ReportController::class)
    ->middleware(['auth', 'approved', \App\Http\Middleware\ConservationistOrAdminMiddleware::class]);
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/pending-users',
        [AdminController::class, 'pendingUsers']);

    Route::post('/admin/approve/{id}',
        [AdminController::class, 'approve']);

});    

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'explorer') {
        return redirect('/explore');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {
    Route::post('/explore/{report}/comments', [CommentController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';