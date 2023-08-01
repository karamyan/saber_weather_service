<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('weather/get_all', [\App\Http\Controllers\Api\WeatherController::class, 'getWeatherInfo'])->name('get_weather_info');
Route::post('weather/get_single', [\App\Http\Controllers\Api\WeatherController::class, 'getSingleWeatherInfo'])->name('get_single_weather_info');
