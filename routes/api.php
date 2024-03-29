<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\SensorVerileriController;

Route::post('/sensor-data', [SensorDataController::class, 'store']);



