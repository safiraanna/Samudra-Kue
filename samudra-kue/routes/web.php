<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/about', function () {return view('footer.about');})->name('about');
Route::get('/contact', function () {return view('footer.contact');})->name('about');
Route::get('/condition', function () {return view('footer.condition');})->name('about');
Route::get('/policy', function () {return view('footer.policy');})->name('about');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/product/{product:id}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('add_to_cart/{id}', [CartController::class, 'addToCart'])->middleware('auth')->name('add_to_cart');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/index', [CartController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout/done', [CartController::class, 'storeCheckout'])->name('checkout.store');

Route::get('/orders', [OrderController::class, 'show'])->name('orders');
Route::get('/orders/{orderID}', [OrderController::class, 'showOrderDetails'])->name('orders.details');
Route::get('/generate-invoice/{orderId}', [InvoiceController::class, 'generateInvoice']);

Route::post('/midtrans/callback', [ApiController::class, 'payment_handler']);
Route::post('/update-checkout', [PaymentController::class, 'updateOrder'])->name('update.checkout');
Route::post('/payment/{orderID}', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/addresses', [ShippingAddressController::class, 'show'])->name('addresses.index');
Route::get('/addresses/create', [ShippingAddressController::class, 'create'])->name('addresses.create');
Route::post('/addresses', [ShippingAddressController::class, 'store'])->name('addresses.store');
Route::get('/addresses/{id}/edit', [ShippingAddressController::class, 'edit'])->name('addresses.edit');
Route::put('/addresses/{id}', [ShippingAddressController::class, 'update'])->name('addresses.update');

Route::get('/admin/order', [AdminController::class, 'showOrder'])->name('process.orders');
Route::put('/update-order-status/{order}', [AdminController::class, 'updateOrderStatus'])->name('updateOrderStatus');
Route::get('/details/{order}', [AdminController::class, 'showOrderDetails'])->name('details.orders');
Route::get('/admin/history', [AdminController::class, 'showFinishedOrder'])->name('finished.orders');

Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('all.users');

Route::get('/admin/products', [AdminController::class,'showProducts'])->name('all.products');
Route::delete('/admin/products/{product}', [AdminController::class, 'destroyProducts'])->name('products.destroy');
Route::get('/admin/products/create', [AdminController::class,'createProducts'])->name('products.create');
Route::post('/admin/products', [AdminController::class,'storeProducts'])->name('products.store');
Route::get('/admin/{product}/edit', [AdminController::class,'editProducts'])->name('products.edit');
Route::put('/admin/{product}', [AdminController::class,'updateProducts'])->name('products.update');

Route::get('/sales-report', [AdminController::class,'monthlySalesReport'])->name('weekly.sales.report');
Route::get('/sales-report/{year}/{month}', [AdminController::class, 'monthlySalesDetails'])->name('weekly.sales.details');
// Route::get('/print-sales-report/{year}/{month}', [AdminController::class, 'printMonthlySalesReport'])->name('admin.report.print-monthly');
Route::get('/sales-eport/print-monthly/{year}/{month}', [AdminController::class, 'printMonthlySalesReport'])->name('admin.report.print-monthly');