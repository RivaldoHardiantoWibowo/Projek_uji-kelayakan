@extends('layouts.template')

@section('content')
<h2>Data Keterlambatan</h2>
<p><a href="/home">Home</a> / Data Keterlambatan</p>
@if (Auth::check())
@if (Auth::user()->role == 'admin')
<a href="{{ route('lates.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
<a href="{{  route('lates.export-excel')  }}"><button class="btn btn-info mt-3">Export Data Keterlambatan</button></a>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lates.show') }}">Rekapitulasi Data</a>
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Information</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($lates as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        {{ $item->students->nis }} <br>
                        {{ $item->students->name }}
                    </td>
                    <td>{{ $item['date_time_late'] }}</td>
                    <td>{{ $item['information'] }}</td>
                    <td class="d-flex justify-content-center pb-4">
                        <a href="{{ route('lates.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="{{ route('lates.destroy', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</li>
</ul>
@else
<a href="{{  route('lates.export-excel')  }}"><button class="btn btn-info mt-3">Export Data Keterlambatan</button></a>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lates.show') }}">Rekapitulasi Data</a>
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($lates as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        {{ $item->students->name }} <br>
                        {{ $item->students->nis }}
                    </td>
                    <td>{{ $item['information']}}</td>
                    <td>{{ $item['date_time_late']}}</td>
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
