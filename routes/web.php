<?php

use App\Http\Controllers\ChargesController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\OpdTimeController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptTypeController;
use App\Http\Controllers\reportController;
use App\Http\Middleware\confirmPassword;
use App\Models\charges;
use App\Models\receipt;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    
Route::get('/', function (){
    return to_route('receipt.create');
})->name('dashboard');

Route::resource('type', ReceiptTypeController::class);
Route::resource('charges', ChargesController::class);
Route::get('receipt/create/{id?}', [ReceiptController::class, 'create'])->name('receipt.create');
Route::get('receipt/print/{id}', [ReceiptController::class, 'print'])->name('receipt.print');
Route::get('receipt/print1/{id}', [ReceiptController::class, 'print1'])->name('receipt.print1');
Route::get('receipt/refund/{id}', [ReceiptController::class, 'refund'])->name('receipt.refund')->middleware(confirmPassword::class);
Route::resource('receipt', ReceiptController::class);

Route::get('/getcharges/{id}', [ChargesController::class, 'getcharges']);

Route::get('opdtime', [OpdTimeController::class, 'index'])->name('opdtime.index');
Route::post('opdtime', [OpdTimeController::class, 'update'])->name('opdtime.update');


Route::get('/report', [reportController::class, 'index'])->name('report.index');
Route::post('/report/print', [reportController::class, 'print'])->name('report.print');

Route::get('checktoken/{token}/{date}', [ReceiptController::class, 'checktoken']);

});




