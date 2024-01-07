@extends('layouts.template')
@section('content')
<h2>Update Data Rayon</h2>
<p><a href="/home">Home</a> / <a href="{{ route('rayon.index') }}">Data Rayon</a> / Update Data Rayon</p>
    <form action="{{ route('rayon.update', $rayon['id']) }}" method="POST" class="card p-5">
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
            <label for="rayon" class="col-sm-2 col-form-laber">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayon['rayon'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">User_id</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id">
                    @foreach ($user as $ray)
                         <option value="{{ $ray->id }}">{{ $ray->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection

