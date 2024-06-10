<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weather;

class APIController extends Controller
{
    public function searchWeatherForecast(Request $request)
    {
        $search = $request->input('q');
        $weather_found = Weather::where('NamaKota','LIKE',"%$search%")->get();
        
        if($weather_found->isEmpty())
        {
            return response()->json([
                'success' => false,
                'data' => 'Data Tidak Ditemukan'
            ], 200 )->header('Access-Control-Allow-Origin','http://127.0.0.1:5500');
        }
        else
        {
            return response()->json([
                'success' => true,
                'data' => $weather_found
            ], 200)->header('Access-Control-Allow-Origin','http://127.0.0.1:5500'); 
        }
    }
}
