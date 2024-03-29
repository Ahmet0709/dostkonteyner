<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorVerisi;
use App\Models\CopKonteyneri;

class SensorVerileriController extends Controller
{

    public function index(Request $request)
    {
        $cop_konteynerleri = CopKonteyneri::all();
    
        return view('index', compact('cop_konteynerleri'));
    }    

    public function getSensorData(Request $request)
    {
        $cop_konteyneri_id = $request->input('cop_konteyneri_id');
        $sensor_verisi = SensorVerisi::where('cop_konteyneri_id', $cop_konteyneri_id)->first();
        
        if ($sensor_verisi) {
            return response()->json([
                'container_id' => $sensor_verisi->cop_konteyneri_id,
                'doluluk_orani' => $sensor_verisi->doluluk_orani,
                'sicaklik' => $sensor_verisi->sicaklik,
                'nem' => $sensor_verisi->nem,
                'hava_kalitesi' => $sensor_verisi->hava_kalitesi
            ]);
        } else {
            return response()->json([
                'error' => 'Sensör verisi bulunamadı.'
            ], 404);
        }
    }
}
