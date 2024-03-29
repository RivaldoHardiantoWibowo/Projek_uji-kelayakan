@extends('layouts.template')

@section('content')
<h2>Tambah Data Rayon</h2>
<p><a href="/home">Home</a> / <a href="{{ route('rayon.index') }}">Data Rayon</a> / Tambah Data Rayon</p>
    <form action="{{ route('rayon.store')}}" method="POST" class="card  p-5">
        @csrf
        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-laber">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-laber">User_id</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
