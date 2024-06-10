@extends('layouts.main')
@section('title','From Add Weather Forecast')
@section('content')
<style>
    .card {
        background-color: #202C3C;
    }
    .card-body {
        background-color: #202C3C; 
    }
    .form-group {
        color: white
    }
    
    .form-group input {
        background-color: #0B131E;
        color: white; /* Ensure the text is readable */
        border: 1px solid #ccc; /* Optional: Add a border for better visibility */
        padding: 5px; /* Optional: Add padding for better appearance */
    }
</style>
        <div class="card-body">
            {{-- FORM MOVIES --}}
            <form action="/save" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Kota</label>
                    <input type="text" name="kota" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kondisi Cuaca</label>
                    <input type="file" name="kondisi" class="form-control-file" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label>Suhu</label>
                    <input type="number" min="-100" max="100" name="suhu" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label>Kelembaban</label>
                    <input type="number" min="0" max="100" name="kelembaban" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kecepatan Angin</label>
                    <input type="number" min="0" max="510" name="kecepatan" class="form-control" required>
                </div>
                <div class="form-gorup">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
@endsection