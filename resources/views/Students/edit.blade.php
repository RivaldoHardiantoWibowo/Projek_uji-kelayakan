@extends('layouts.template')
@section('content')
<h2>Update Data Siswa</h2>
<p><a href="/home">Home</a> / <a href="{{ route('student.index') }}">Data Siswa</a> / Update Data Siswa</p>
    <form action="#" method="POST" class="card p-5">
        @csrf
        @method('PATCH')
        {{-- {{ route('rayon.update', $rayon['id']) }} --}}
        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-laber">Nis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $student['nis'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-laber">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $student['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">rombel_id</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel_id">
                    @foreach ($rombel as $ray)
                         <option value="{{ $ray->id }}">{{ $ray->rombel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon id</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon_id">
                    @foreach ($rayon as $ray)
                         <option value="{{ $ray->id }}">{{ $ray->rayon }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection

