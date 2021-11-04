<?php

use App\Http\Controllers\IssueController;
use App\Http\Livewire\TicketList;
use App\Models\Client;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    return redirect()->to("/dashboard");
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
            Route::get('/view/{id}', [IssueController::class, 'details'])->name('details');
            Route::get('/kanboard', function () {
                return view('issues.kanboard');
            })->name('kanboard');
            Route::get('/{id}', [IssueController::class, 'details']);
        });
    });
});
