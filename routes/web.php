<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FillingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard_new');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [DashboardController::class, 'dashboardPage'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//Page Route
Route::get('/about',[HomeController::class,'aboutUs']);
Route::get('/service',[HomeController::class,'service']);
Route::get('/process',[HomeController::class,'process']);
Route::get('/contact',[HomeController::class,'contactUs']);




//Dashboard Functionality
Route::get('/summary', [DashboardController::class, 'summary']);

//Setting Page Route (This page is used to Role & Permission)
Route::get('/setting-page', [SettingController::class, 'settingPage'])->name('settingPage');


//User CRUD
//view page
Route::get('/user-page', [UserController::class, 'userPage'])->name('user-page');
Route::get('/show-user', [UserController::class,'showUser']);
Route::post('/create-user', [UserController::class,'createUser']);
Route::post('/get-user', [UserController::class,'getUser']);
Route::put('/update-user', [UserController::class,'updateUser']);
Route::delete('/delete-user', [UserController::class, 'deleteUser']);


//Product Page Route
//page View
Route::get('/productPage', [ProductController::class, 'productPage'])->name('productPage');
Route::get('/show-product', [ProductController::class, 'showProduct']);
Route::post('/create-product', [ProductController::class, 'createProduct']);
Route::post('/delete-product', [ProductController::class, 'deleteProduct']);
// get product id route
Route::post('/get-product', [ProductController::class, 'getProduct']);
Route::post('/update-product', [ProductController::class, 'updateProduct']);


//Dealer Page Route
//page view
Route::get('/dealerPage',[DealerController::class, 'dealerPage'])->name('dealerPage');
Route::get('/show-dealer', [DealerController::class,'showDealer']);
Route::post('/create-dealer', [DealerController::class,'createDealer']);
Route::delete('/delete-dealer', [DealerController::class,'deleteDealer']);
Route::post('/get-dealer', [DealerController::class,'getDealer']);
Route::post('/update-dealer', [DealerController::class,'updateDealer']);



//RefillProduction Page
//page view
Route::get('/productionPage', [FillingController::class, 'productionPage'])->name('productionPage');
Route::get('/show-filling', [FillingController::class, 'showFilling']);
Route::post('/create-filling', [FillingController::class, 'createFilling']);
Route::post('/delete-filling', [FillingController::class, 'deleteFilling']);
Route::post('/get-filling', [FillingController::class, 'getFilling']);
Route::post('/update-filling', [FillingController::class, 'updateFilling']);


//Order/Invoice Page Route
Route::get('/invoicePage', [InvoiceController::class, 'invoicePage'])->name('invoicePage');
Route::post('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('createInvoice');
Route::get('/order-page', [InvoiceController::class, 'orderPage'])->name('orderPage');
Route::get('/show-invoice', [InvoiceController::class, 'showInvoice']);
Route::get('/get-invoice-by-id/{id}', [InvoiceController::class, 'getInvoice']);















Route::get("/invoice-select",[InvoiceController::class,'invoiceSelect']);
Route::get('/invoice-details', [InvoiceController::class, 'InvoiceDetails']);


Route::delete('/delete-invoice', [InvoiceController::class, 'deleteInvoice']);








//Delivery Page Route
Route::get('/deliveryPage', [DeliveryController::class, 'deliveryPage'])->name('deliveryPage');
// Route to get all pending deliveries
Route::get('/get-pending-order', [DeliveryController::class, 'getPendingOrders']);
// Route to mark an order as delivered
Route::post('/mark-as-delivered/{id}', [DeliveryController::class, 'markAsDelivered']);

Route::post('/delivery-info', [DeliveryController::class, 'saveDelivery']);
