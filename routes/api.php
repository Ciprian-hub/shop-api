<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\ProductController;

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

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);

    Route::apiResource('customers', CustomerController::class);
    Route::get('countries', [CustomerController::class, 'getCountries']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order}', [OrderController::class, 'view']);

    Route::get('/dashboard/customers', [DashboardController::class, 'activeCustomers']);
    Route::get('/dashboard/products', [DashboardController::class, 'activeProducts']);
    Route::get('/dashboard/orders', [DashboardController::class, 'paidOrders']);
    Route::get('/dashboard/total', [DashboardController::class, 'totalIncome']);
    Route::get('/dashboard/orders-country', [DashboardController::class, 'ordersByCountry']);
    Route::get('/dashboard/latest-customers', [DashboardController::class, 'latestCustomers']);
    Route::get('/dashboard/latest-orders', [DashboardController::class, 'latestOrders']);

    // Report routes
    Route::get('/reports/orders', [ReportController::class, 'orders']);
    Route::get('/reports/customers', [ReportController::class, 'customers']);
});
Route::post('/login', [AuthController::class, 'login']);
