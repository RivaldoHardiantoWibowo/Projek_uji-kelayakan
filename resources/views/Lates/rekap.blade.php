@extends('layouts.template')

@section('content')
<h2>Data Keterlambatan</h2>
<p><a href="/home">Home</a> / Data Keterlambatan </a></p>
@if (Auth::check())
@if (Auth::user()->role == 'admin')
<a href="{{ route('lates.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
<a href="{{ route('lates.export-excel') }}"><button class="btn btn-info mt-3">Export Data Keterlambatan</button></a>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lates.index') }}">Keseluruhan Data</a>
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah keterlambatan </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($students as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nis }}</td>
                    <td> {{ $item->name }}</td>
                    <td>{{ App\Models\lates::where('student_id', $item->id)->count() }}</td>
                    <td><a href="{{ route('lates.lihat', $item['id']) }}">lihat</a></td>
                    @if ( App\Models\lates::where('student_id', $item->id)->count() >=3)
                    <td><a href="{{ route('lates.download', $item['id']) }}"><button class="btn btn-primary mt-3">Cetak Surat Pernyataan</button></a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</li>
</ul>
@else
<a href="{{ route('lates.export-excel') }}"><button class="btn btn-info mt-3">Export Data Keterlambatan</button></a>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lates.index') }}">Keseluruhan Data</a>
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah keterlambatan </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($late as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->students->nis }}</td>
                    <td> {{ $item->students->name }}</td>
                    <td>{{ App\Models\lates::where('student_id', $item->students->id)->count() }}</td>
                    <td><a href="{{ route('lates.lihat', $item['id']) }}">lihat</a></td>
                    @if ( App\Models\lates::where('student_id', $item->students->id)->count() >=3)
                    <td><a href="{{ route('lates.download', $item['id']) }}"><button class="btn btn-primary mt-3">Cetak Surat Pernyataan</button></a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</li>
</ul>
@endif
@endif
@endsection

{{-- {{ route('rombel.create') }} --}}
{{-- {{ route('rombel.edit', $item['id']) }} --}}
{{-- {{ route('rombel.delete', $item['id']) }} --}}
