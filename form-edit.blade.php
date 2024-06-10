@extends('layouts.main')
@section('title','From Edit Weather Forecast')
@section('content')
    <style>
        .card-body{
            background-color: #202C3C;
        }
    </style>
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            {{-- FORM MOVIES --}}
            <form action="/update/{{ $weather_data->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $weather_data->Tanggal }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Kota</label>
                    <input type="text" name="kota" class="form-control" value="{{ $weather_data->NamaKota }}" required>
                </div>
                <div class="form-group">
                    <label>Kondisi Cuaca</label>
                    <input type="file" name="kondisi" class="form-control-file" accept="image/*" required>
                </div>
                <div class="form-group">
                    <img src="{{ asset('/storage/'.$weather_data->KondisiCuaca) }}" alt="{{ $weather_data->KondisiCuaca }}" height="100px" width="100px">
                </div>
                <div class="form-group">
                    <label>Suhu</label>
                    <input type="number" min="-100" max="100" name="suhu" class="form-control" value="{{ $weather_data->Suhu }}" required>
                </div>
                <div class="form-group">
                    <label>Kelembaban</label>
                    <input type="number" min="0" max="100" name="kelembaban" class="form-control" value="{{ $weather_data->Kelembaban }}" required>
                </div>
                <div class="form-group">
                    <label>Kecepatan Angin</label>
                    <input type="number" min="0" max="510" name="kecepatan" class="form-control" value="{{ $weather_data->KecepatanAngin }}" required>
                </div>
                <div class="form-gorup">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection