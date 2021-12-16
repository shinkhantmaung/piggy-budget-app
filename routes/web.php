<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscationController;
use App\Http\Controllers\HomeController;

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
    if (Auth::user()) {
        return redirect()->route('home.index');
    }
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){

    //Home Control
    Route::get('/home',[HomeController::class,'index'])->name('home.index');
    Route::post('/home', [TranscationController::class,'store'])->name('transaction.store');

    //Transaction
    Route::get('/transaction',[TranscationController::class,'index'])->name('transaction.index');
    Route::get('/transaction/{id}', [TranscationController::class,'show'])->name('transaction.show');
    Route::post('/transaction/{id}', [TranscationController::class,'destroy'])->name('transaction.destroy');

    //Settings
    Route::get('/settings',function(){
        return view('back.settings.index');
    });
});
