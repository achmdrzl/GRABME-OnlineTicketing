<?php

use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\MasterDataController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
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
    return User::with(['profile'])->get();
});

Route::get('/home', function () {
    return view('frontend.index');
});

Route::get('/home/product', function () {
    return view('frontend.event-details');
});

Route::get('/home/checkout', function(){
    return view('frontend.checkout');
});

Route::get('/admin', function(){
    return view('backend.dashboard');
});

// User Index
Route::get('/admin/data-user', MasterDataController::class. '@datauser')->name('user.index');

// User Store or Update
Route::post('/admin/userStore', MasterDataController::class. '@userStore')->name('user.store');

// User Selected
Route::post('/admin/userSelected', MasterDataController::class. '@userSelected')->name('user.selected');

// User Destroy
Route::post('/admin/userDestroy', MasterDataController::class. '@userDestroy')->name('user.destroy');

// Events Index
Route::get('/admin/data-event', MasterDataController::class. '@dataevent')->name('event.index');

// Add Event UI
Route::get('/admin/eventAdd', MasterDataController::class. '@eventAdd')->name('event.add');

// Event Store
Route::post('/admin/eventStore', EventController::class. '@eventStore')->name('event.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
