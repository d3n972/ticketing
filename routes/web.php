<?php

use App\Http\Controllers\IssueController;
use App\Http\Livewire\TicketList;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/processPayment', [\App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.process');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/afterPayment', [\App\Http\Controllers\PaymentController::class, 'afterPayment'])->name('payment.after');
    Route::prefix('issue')->group(function () {
        Route::name('issue.')->group(function () {
            Route::get('/', TicketList::class)->name('list');
            Route::get('/new', [IssueController::class, 'new'])->name('create');
            Route::post('/modify', [IssueController::class, 'modify_ticket'])->name('modify');
            Route::get('/view/{id}', [IssueController::class, 'details'])->name('details');
            Route::post('/assign', [IssueController::class, 'assign_ticket'])->name('assign');
            Route::post('/lock', [IssueController::class, 'switchStatus'])->name('lock');
            Route::get('/{id}', [IssueController::class, 'details']);
        });
    });
});
