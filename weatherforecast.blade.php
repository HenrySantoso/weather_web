@extends('layouts.main')
@section('title', 'Info Cuaca')
@section('content')
<style>
    .card {
        background-color: #26283B;
    }

    table {
        color: white; /* Text color for the table */
        border-color: white; /* Border color for the table */
    }

    table th, table td {
        border: 1px solid white; /* Border color for table cells */
    }

    table thead th {
        border-bottom: 2px solid white; /* Thicker border for the table header */
    }

    .btn {
        color: white; /* Ensure button text is visible */
    }

    /* DataTables specific styles */
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_paginate .paginate_button,
    .dataTables_wrapper .dataTables_info {
        color: white; /* Text color */
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        background-color: #26283B; /* Background color */
        border: 1px solid white; /* Border color */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #26283B; /* Background color */
        border: 1px solid white; /* Border color */
        margin-left: 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #444466; /* Different background for active/hover state */
        border: 1px solid white; /* Border color */
    }

    /* Ensure DataTable header and footer are white */
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_info {
        color: white; /* Text color */
    }

    /* Additional styles for DataTable */
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_info {
        color: white; /* Text color */
    }
</style>

<div class="card">
    {{-- header --}}
    <div class="card-header">
        <a href="/weatherforecast/add-form" class="btn btn-primary"><i class="bi bi-plus-square"></i> Tambah Cuaca</a>
    </div>
    {{-- content --}}
    <div class="card-body">
        @if (session('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        {{-- table data --}}
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tanggal</th>
                    <th>Nama Kota</th>
                    <th>Kondisi Cuaca</th>
                    <th>Suhu</th>
                    <th>Kelembaban</th>
                    <th>Kecepatan Angin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weather_data as $index => $item)
                <tr>
                    <td>{{ $index + 1}}</td>
                    <td>{{ $item -> Tanggal}}</td>
                    <td>{{ $item -> NamaKota}}</td>
                    <td>
                        <img src="{{ asset('/storage/'.$item->KondisiCuaca) }}" 
                        alt="{{ $item->KondisiCuaca }}" height="100px" width="100px">
                    </td>
                    <td>{{ $item -> Suhu}}</td>
                    <td>{{ $item -> Kelembaban}}</td>
                    <td>{{ $item -> KecepatanAngin}}</td>
                    <td>
                        <a href="/weatherforecast/edit-form/{{ $item->id }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="/delete/{{ $item->id }}" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                    </td>
                </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Include jQuery and DataTables JS (make sure these are included in your project) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
