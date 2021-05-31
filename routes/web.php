<?php

use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\ValidatorController;
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

Route::get('/get-validator', [ValidatorController::class, 'getValidatorData']);
Route::get('/get-business-type', [BusinessTypeController::class, 'getBusinessTypeData']);
