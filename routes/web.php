<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrameController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\LocationFrameController;
use App\Http\Controllers\Admin\BillingInfoController;
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

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Frame Management Routes
    Route::resource('frames', FrameController::class);

    // Location Management Routes
    Route::resource('locations', LocationController::class);

    // Device Management Routes
    Route::resource('devices', DeviceController::class);

    // Location Frame Configuration Routes
    Route::resource('location-frames', LocationFrameController::class)
        ->parameters(['location-frames' => 'location'])
        ->only(['index', 'edit', 'update']);

    Route::put('location-frames/{location}/toggle-config-status', [LocationFrameController::class, 'toggleConfigStatus'])->name('location-frames.toggle-config-status');

    // Billing Information Route
    Route::resource('billing', BillingInfoController::class)->only(['index', 'store']);
});

// Add this route to define admin.report.sales
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/reports/sales', function () {
        return view('admin.reports.sales');
    })->name('admin.report.sales');
});

require __DIR__.'/auth.php';
