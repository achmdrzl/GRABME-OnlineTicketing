<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\MasterDataController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\FrontEnd\FrontController;
use App\Http\Controllers\ProfileController;
use App\Models\Events;
use App\Models\TicketCategory;
use App\Models\Transaction;
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

Route::get('/cek', function () {
    $data = TicketCategory::where('event_id', 4)->pluck('ticket_category_id');
    $data2 = TicketCategory::whereIn('ticket_category_id', $data)->get();

    return $data2;
});

// index ticket
Route::get('/', FrontController::class . '@index')->name('index');

// get detail event
Route::get('/home/event/{slug}', FrontController::class . '@eventDetails')->name('event.details');

// get ticket category by selected event
Route::post('/getTicketCategory', FrontController::class . '@getTicketCategory')->name('get.ticketCategory');

// get data order ticket and redirect to confirm order
Route::post('/checkout', FrontController::class . '@checkoutTicket')->name('checkout.ticket');

// get total amount order
Route::post('/getTotal', FrontController::class . '@getTotal')->name('get.amountPrice');

// show ticket
Route::get('/show-ticket/{order_id}', FrontController::class . '@showTicket')->name('show.index');

Route::group(['middleware' => ['role:user', 'auth']], function () {

    // user dashboard
    Route::get('/home/dashboard', FrontController::class . '@dashboardUser')->name('dashboard.user');

    // update user data
    Route::post('/home/update-user-data', FrontController::class . '@updateUserData')->name('update.userData');

    // update password user
    Route::post('/home/update-user-password', FrontController::class . '@updatePasswordUser')->name('update.Userpassword');

    // user ticket
    Route::get('/home/user-tickets', FrontController::class . '@ticketIndex')->name('ticket.index');

    // index confirm order
    Route::get('/home/confirm', FrontController::class . '@confirmOrder')->name('confirm.order');

    // create order data
    Route::post('/order', FrontController::class . '@order')->name('order');

    // store order data
    Route::post('/orderStore', FrontController::class . '@orderDataStore')->name('order.store');

    // continue order
    Route::post('/continueOrder', FrontController::class . '@continueOrder')->name('continue.order');

    // get user regis by login
    Route::get('/getRegisUser', FrontController::class . '@getRegisUser')->name('get.dataRegis');

    // get history transaction
    Route::get('/home/transaction', FrontController::class . '@history')->name('history.index');
    Route::get('/historyTransaction', FrontController::class . '@getHistory')->name('history.transaction');

    // detail transaction
    Route::get('/history/detail/{order_id}', FrontController::class . '@detailTransaction')->name('detail.transaction');

    // cancel order
    Route::post('/cancelOrder', FrontController::class . '@cancelOrder')->name('cancel.order');

    // delete session order
    Route::post('/delete-session', FrontController::class . '@deleteSession')->name('delete.session');

    // delete data transaction while that order has been canceled
    Route::post('/deleteTransaction', FrontController::class . '@deleteTransaction')->name('delete.transaction');

    // etiket
    Route::get('/etiket/{order_id}', FrontController::class . '@etiket')->name('etiket.index');
});



Route::group(['middleware' => ['role:admin|manager', 'auth']], function () {

    Route::get('/dashboard', DashboardController::class . '@index')->name('admin.index');

    // User Index
    Route::get('/data-user', MasterDataController::class . '@datauser')->name('user.index');

    // User Store or Update
    Route::post('/userStore', MasterDataController::class . '@userStore')->name('user.store');

    // User Selected
    Route::post('/userSelected', MasterDataController::class . '@userSelected')->name('user.selected');

    // User Destroy
    Route::post('/userDestroy', MasterDataController::class . '@userDestroy')->name('user.destroy');

    // Events Index
    Route::get('/data-event', EventController::class . '@eventIndex')->name('event.index');

    // Add Event UI
    Route::get('/eventAdd', MasterDataController::class . '@eventAdd')->name('event.add');

    // Event Store
    Route::post('/eventStore', EventController::class . '@eventStore')->name('event.store');

    // Event Update
    Route::post('/eventUpdate', EventController::class . '@eventUpdate')->name('event.update');

    // Get Event Data
    Route::post('/eventShow', EventController::class . '@eventGetData')->name('get.event.data');

    // Event Show
    Route::get('/event/show/{id}', EventController::class . '@eventShow')->name('event.show');

    // Event Edit
    Route::get('/event/edit/{id}', EventController::class . '@eventEdit')->name('event.edit');

    // Event Update Status
    Route::post('/event/updateStatus', EventController::class . '@updateStatusEvent')->name('eventUpdate.status');

    // Get Ticket Category
    Route::post('/event/getTicketCategory', EventController::class . '@getTicketCategory')->name('get.TicketCategory');

    // Delete Ticket Category
    Route::post('/event/destroyTicketCategory', EventController::class . '@ticketCategoryDestory')->name('ticketCategory.destroy');

    // data Transaction
    Route::get('/transactionIndex', TransactionController::class . '@transactionIndex')->name('transaction.index');
    Route::get('/event-transaction', TransactionController::class . '@eventTransaction')->name('transaction.event');

    // get transaction data
    Route::post('/transactionGetData', TransactionController::class . '@transactionGetData')->name('get.transaction.data');
    Route::get('/transactionShow/{id}', TransactionController::class . '@transactionShow')->name('transaction.show');

    // get detail transaction
    Route::post('/detail-transaction', TransactionController::class . '@getDetailTransaction')->name('show.transaction');

    // update cetaik
    Route::post('/update-cetak', TransactionController::class . '@updateCetak')->name('update.cetak');
});


Route::get('/cek', function(){
    phpinfo();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
