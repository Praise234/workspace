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
Route::post('/send_mail', [adminController::class, 'SendMail'])->name('send_mail');
Route::get('/get_category_details', [adminController::class, 'getCategoryDetails'])->name('get_category_details');
Route::middleware(['auth_check'])->group(function () {
    Route::prefix('administrator')->group(function () {
        Route::get('/',  [adminController::class, 'dashboard'])->name('dashboard');
        Route::get('/confirm_booking', [adminController::class, 'confirmBooking']);
        Route::post('/confirm_booking_search', [adminController::class, 'confirmBooking_search']);
        Route::get('/categories/', [adminController::class, 'showCategories']);
        Route::post('/add_category', [adminController::class, 'addCategory'])->name("add_category");
        Route::post('/update_category', [adminController::class, 'updateCategory'])->name("update_category");
        Route::get('/delete_category', [adminController::class, 'deleteCategory'])->name('delete_category');
        Route::get('/unavailable', [adminController::class, 'showUnavailable']);
        Route::post('/update_unavailable', [adminController::class, 'updateUnavailable'])->name('update_unavailable');
        Route::get('/delete_unavailable', [adminController::class, 'deleteUnavailable'])->name('delete_unavailable');
        Route::post('/add_unavailable', [adminController::class, 'addUnavailable'])->name('add_unavailable');
        Route::get('/show_variations', [adminController::class, 'showVariations'])->name('show_variations');
        Route::post('/variation_search', [adminController::class, 'variationSearch'])->name('variation_search');
        Route::post('/update_variation', [adminController::class, 'updateVariation'])->name('update_variation');
        Route::post('/add_variation', [adminController::class, 'addVariation'])->name('add_variation');
        Route::post('/delete_variation', [adminController::class, 'deleteVariation'])->name('delete_variation');

        
    });
});
