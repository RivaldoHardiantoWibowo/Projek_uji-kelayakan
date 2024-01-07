@extends('layouts.template')

@section('content')
<div class="jumbotron py-4 px-5">
    <div class="jumbotron py-4 px-5  ">
        <h2>Dashboard</h2>
        <p><a href="/home">Home</a> / Dashboard</p>
    <div class="container mt-5">
        <div class="row">
            @if (Auth::check())
            @if (Auth::user()->role == 'admin')
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                        <h5 class="card-title text-center"><i class='bx bx-user nav_icon'></i>   Peserta Didik</h5>
                        <p class="card-text text-center">{{ $jmlStudent }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                        <h5 class="card-title text-center"> <i class='bx bx-folder nav_icon'></i>Administrator</h5>
                        <p class="card-text text-center">{{ $jmlAdmin }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                        <h5 class="card-title text-center"><i class='bx bx-folder nav_icon'></i> Pembimbing Siswa</h5>
                        <p class="card-text text-center">{{ $jmlPs }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-6">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                            <h5 class="card-title text-center"> <i class='bx bx-bookmark nav_icon'></i> Rombel</h5>
                        <p class="card-text text-center"> {{ $jmlRombel }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-6">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                        <h5 class="card-title text-center">Rayon</h5>
                        <p class="card-text text-center">{{ $jmlRayon }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <h5 class="card-title text-center"><i class='bx bx-user nav_icon'></i>   Peserta Didik <br><b style="color: blue">{{ Auth::user()->name }}</b></h5>
                <p class="card-text text-center">{{ $tstudents }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-body">
                <h5 class="card-title text-center"><i class='bx bx-user nav_icon'></i>   Jumlah Siswa Yang Terlambat</h5>
                <p class="card-text text-center">{{ $today }}</p>
            </div>
        </div>
    </div>
@endif
@endif


@endsection

