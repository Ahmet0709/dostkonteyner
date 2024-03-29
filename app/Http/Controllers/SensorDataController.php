<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData; 

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->input('data');
        
        SensorData::create([
            'data' => $data,
        ]);

        return response()->json(['message' => 'Veri başarıyla kaydedildi.'], 201);
    }
}
