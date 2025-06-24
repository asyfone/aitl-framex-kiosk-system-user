<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationFrameApiController;
use App\Http\Controllers\Api\DeviceAuthController;
use App\Http\Controllers\API\BillingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Location Frame API
Route::get('/location-frames', [LocationFrameApiController::class, 'index']);

// Device Authentication Route
Route::post('/device/authenticate', [DeviceAuthController::class, 'authenticate']);

// Get Frames by Device ID
Route::get('/frames/device', [LocationFrameApiController::class, 'getFramesByDeviceId']);

// Billing Route
Route::post('/billing/store', [BillingController::class, 'store']);
use App\Http\Controllers\API\DeviceSearchController;

Route::post('/device-search', [DeviceSearchController::class, 'search']);

