<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\UserReportControler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RegisterController;


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

Route::get('/', function () {
    return view('auth.login');
});

// Route::post('register', [RegisterController::class, 'register']);
// Route::get('/rubex12345@', [RegisterController::class, 'showRegistrationForm'])
//     ->name('register');

    Route::get('/register', function () {
        
        return response('', 404);
    });
    

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change-language');
Route::get('/invoices/export', [InvoiceReportController::class, 'export'])->name('invoices-export');



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/{page}', [AdminController::class, 'index']);
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth', 'isactive']], function () {
        Route::resource('invoices', InvoicesController::class);
        
        Route::resource('products', ProductsController::class);
        Route::resource('sections', SectionsController::class);
        Route::resource('invoicesAtt', InvoicesAttachmentsController::class);
        Route::get('/invoice_reports', [InvoiceReportController::class, 'index'])->name('invoice_report');
        Route::get('/invoiceArchive', [InvoicesController::class, 'getInvoicesArchived'])->name('invoiceArchive');
        Route::get('/markAsRead', [InvoicesController::class, 'markAllNotificationsAsRead'])->name('markAsRead');
        Route::get('/print_invoice/{id}', [InvoicesController::class, 'printInvoice'])->name('printInvoice');
        Route::put('/restoreInvoice/{id}', [InvoicesController::class, 'restoreInvoice'])->name('restoreInvoice');
        Route::post('/invoice/{id}', [InvoicesController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/invoice/{id}', [InvoicesController::class, 'transformToArchived'])->name('transformToArchived');
        Route::post('/search_invoice', [InvoiceReportController::class, 'Search_invoices'])->name('Search_invoices');
        Route::post('/export_invoices', [InvoiceReportController::class, 'exportToCSV'])->name('export_invoices');
        Route::post('/search_customer', [UserReportControler::class, 'Search_customers'])->name('Search_customers');
        Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
        Route::resource('users', UserController::class)->middleware(['auth',]);
        Route::get('/users_report', [UserReportControler::class, 'index'])->name('user_report');
        Route::get('/invoices_status/{status}', [InvoicesController::class, 'getInvoicesByStatus'])->name('invoiceStatus');
        
    });
});
