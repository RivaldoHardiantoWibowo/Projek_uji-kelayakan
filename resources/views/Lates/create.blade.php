@extends('layouts.template')

@section('content')
<h2>Tambah Data Keterlambatan</h2>
<p><a href="/home">Home</a> / <a href="{{ route('lates.index') }}">Data Keterlambatan</a> / Tambah Data Keterlambatan</p>
    <form action="{{ route('lates.store')}}" method="POST" class="card  p-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-laber">Name</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-select">
            @foreach ($student as $data)
                <option  value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-laber">Waktu Terlambat</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-laber">information</label>
            <div class="col-sm-10">
                <textarea name="information" id="information" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-laber">Bukti</label>
            <div class="col-sm-10">
                <input type="file" name="bukti" id="bukti">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
