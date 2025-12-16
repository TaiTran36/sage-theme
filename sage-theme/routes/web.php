<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', [FootballController::class, 'index']);
