<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weather;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function login()
    {
        return view("login");
    }

    public function news()
    {
        return view("news", ["key" => "News"]);
    }

    public function weatherForecast()
    {
        $weather = Weather::orderBy('id','desc') -> get();
        return view("weatherforecast", ["key" => "Weather Forecast", "weather_data" => $weather]);
    }

    public function addWeatherForecast()
    {
        return view("form-add", ["key" => "Weather Forecast"]);
    }

    public function saveWeatherForecast(Request $request)
    {
        $file_name = time().'-'.$request->file('kondisi')->getClientOriginalName();
        $path = $request->file('kondisi')->storeAs('kondisi',$file_name,'public');
        Weather::create([
            'Tanggal' => $request->tanggal,
            'NamaKota' => $request->kota,
            'KondisiCuaca' => $path,
            'Suhu' => $request->suhu,
            'Kelembaban' => $request->kelembaban,
            'KecepatanAngin' => $request->kecepatan
        ]);
        return redirect('/weatherforecast')->with('alert','Data berhasil disimpan');
    }

    public function editWeatherForecast($id)
    {
        $weather = Weather::find($id);
        return view("form-edit", ["key" => "Weather Forecast", "weather_data" => $weather]);
    }

    public function updateWeatherForecast($id, Request $request)
    {
        //get id
        $weather = Weather::find($id);
        //update
        $weather->Tanggal = $request->tanggal;
        $weather->NamaKota = $request->kota;
        $weather->Suhu = $request->suhu;
        $weather->Kelembaban = $request->kelembaban;
        $weather->KecepatanAngin = $request->kecepatan;
        //delete image
        if($request->kondisi)
        {
            if($weather->KondisiCuaca)
            {
                Storage::disk('public')->delete($weather->KondisiCuaca);
            }
            $file_name = time().'-'.$request->file('kondisi')->getClientOriginalName();
            $path = $request->file('kondisi')->storeAs('kondisi',$file_name,'public');
            $weather->KondisiCuaca = $path;
        }
        //save
        $weather->save();
        return redirect('/weatherforecast')->with('alert','Data berhasil diubah');
    }

    public function deleteWeatherForecast($id)
    {
        $weather = Weather::find($id);
        if($weather->KondisiCuaca)
        {
            Storage::disk('public')->delete($weather->KondisiCuaca);
        }
        $weather->delete();
        return redirect('/weatherforecast')->with('alert','Data berhasil dihapus');
    }

    public function userEditForm()
    {   
        return view('form-edit-user', ["key" => ""]);
    }

    public function updateUser(Request $request)
    {   
        // mengambil informasi user yang login (nama, email, password)
        $user = Auth::user();
        if(Hash::check($request->old_password, $user->password))
        {
            if($request->new_password == $request->confirmation_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect('/user')->with("info", "Password berhasil diubah");
            } 
            else 
            {
                return redirect('/user')->with("info", "Password gagal diubah");
            }
        }
        else
        {
            return redirect('/user')->with("info", "Password lama salah");
        }
    }
}