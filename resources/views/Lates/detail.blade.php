@extends('layouts.template')

@section('content')
@if (Auth::check())
@if (Auth::user()->role == 'admin')
    <h2>Detail Data Keterlambatan</h2>
    <p><a href="/home">Home</a> / <a href="{{ route('lates.index') }}">Data Keterlambatan </a> / Detail data keterlambatan </p>
        <h5>{{ $students->name }} | {{ $students->nis }} | {{ $students->rayon->rayon }} | {{ $students->rombel->rombel }}</h5>
        <br>
    @foreach ($lates as $index => $late)

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h5 class="card-title">Keterlambatan Ke-{{ $index + 1 }}</h5>
                    <div class="p-5">
                        <p class="card-text">{{ $late->date_time_late }}</p>
                        <p class="card-text">{{ $late->information }}</p>
                        <img src="{{ URL('storage/images/' . $late->bukti) }}" alt="bukti keterlambatan" class="img-fluid" width="150">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <h2>Detail Data Keterlambatan</h2>
    <p><a href="/home">Home</a> / <a href="{{ route('lates.index') }}">Data Keterlambatan </a> / Detail data keterlambatan </p>
        <h5>{{ $lates->students->nis }} | {{ $lates->students->name }} | {{ $lates->students->rombel->rombel }} | {{ $lates->students->rayon->rayon }}</h5>
        <br>
    @foreach ($lates as $index => $late )
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body custom-card-body">
                    @php
                        $i =1;
                        $i++
                    @endphp
                    <h5 class="card-title">Keterlambatan Ke-{{ $i+1 }}</h5>
                    <div class="p-5">
                        <p class="card-text">{{ $lates->date_time_late }}</p>
                        <p class="card-text">{{ $lates->information }}</p>
                     <img src="{{ URL('storage/images/' . $lates->bukti) }}" alt="sbukti keterlambatan" class="img-fluid" width="150">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endif
@endif

@endsection

{{-- {{ route('rombel.create') }} --}}
{{-- {{ route('rombel.edit', $item['id']) }} --}}
{{-- {{ route('rombel.delete', $item['id']) }} --}}
