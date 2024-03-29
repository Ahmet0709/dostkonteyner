<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorVerileriController;
use App\Http\Controllers\CopKonteyneriController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/sensor-verileri', [SensorVerileriController::class, 'index'])->name('sensor-verileri');


Route::get('/get-sensor-data', [SensorVerileriController::class, 'getSensorData'])->name('get-sensor-data');

