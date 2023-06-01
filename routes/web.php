<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

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

Route::get('/',  [adminController::class, 'welcome'])->name('welcome');
Route::view('/administrator/login', 'admin.login')->name('login');
Route::post('/administrator/login_user', [adminController::class, 'loginUser'])->name('check-user');
Route::get('/administrator/logout', [adminController::class, 'logout'])->name('logout');
Route::get('/check_coworkspace_availability', [adminController::class, 'checkCoworkspaceAvailability'])->name('check_coworkspace_availability');
Route::get('/book_now', [adminController::class, 'BookNow'])->name('book_now');
Route::post('/book_coworkspace_page', [adminController::class, 'bookCoworkspacePage'])->name('book_coworkspace_page');
Route::middleware(['auth_check'])->group(function () {
    Route::prefix('administrator')->group(function () {
        Route::get('/',  [adminController::class, 'dashboard'])->name('dashboard');
        Route::get('/confirm_booking', [adminController::class, 'confirmBooking']);
        Route::post('/confirm_booking_search', [adminController::class, 'confirmBooking_search']);
        Route::get('/products/{product_name}', [adminController::class, 'showProducts']);
        Route::post('/products/{product_name}/product_update', [adminController::class, 'updateProduct'])->name("product_update");
        Route::get('/unavailable', [adminController::class, 'showUnavailable']);
        Route::post('/update_unavailable', [adminController::class, 'updateUnavailable'])->name('update_unavailable');
        Route::get('/delete_unavailable', [adminController::class, 'deleteUnavailable'])->name('delete_unavailable');
        Route::post('/add_unavailable', [adminController::class, 'addUnavailable'])->name('add_unavailable');
    });
});
