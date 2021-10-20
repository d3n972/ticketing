<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('issue')->group(function () {
        Route::name('issue.')->group(function () {
            Route::get('/', function (Request $request) {
                $uid = $request->user()->id;
               /* $__tok = DB::table('personal_access_tokens')
                    ->select('id', 'token')
                    ->where('tokenable_id', '=', $uid)
                    ->where('name', '=', 'js_token')
                    ->limit(1)
                    ->first();
                $tok = $__tok->token;

                if ($tok == null) {
                    $tok = $request->user()->createToken('js_token')->plainTextToken;
                }*/
                $tok=$request->user()->createToken('js_token')->plainTextToken;
                return view('issues.list', [
                    'token' => $tok
                ]);
            })->name('list');
            Route::get('/new', function () {
                return view('issues.create');
            })->name('create');
        });
    });
});
