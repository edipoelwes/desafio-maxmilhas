<?php

use App\Http\Controllers\api\CpfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cpf', [CpfController::class, 'index']);
Route::post('/cpf', [CpfController::class, 'store']);
Route::get('/cpf/{cpf}', [CpfController::class, 'show']);
