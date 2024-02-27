@php
    use Illuminate\Support\Facades\Auth;
    $currentPath = Request::path();
    $user = Auth::user();
@endphp
@extends('template')

@section('title')
    <title>Sikasiduk - Dashboard</title>
@endsection

@section('header')
    <h1>
        Dasboard
    </h1>
@endsection

@section('body')
    <div class="row">
        <div class="col-12 mb-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="hero text-white hero-bg-image"
                data-background="{{ asset('stisla/assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg') }}"
                style="background-image: url(&quot;{{ asset('stisla/assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg') }}&quot;);">
                <div class="hero-inner">
                    <h2>Selamat Datang, {{ $user->name }}</h2>
                    <p class="lead">Pemilu sarana integrasi bangsa!</p>
                    <div class="mt-4">
                        {{-- <span class="badge badge-light">
                            <p>100 Hari Menuju Pemilu</p>
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Population Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Jumlah Penduduk</h2>
                    <h5 class="card-text"><i class="fas fa-users"></i> {{$data->count()}} </h5>
                </div>
            </div>
        </div>

        <!-- Display Number of TPS Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Jumlah TPS</h2>
                    <h5 class="card-text"><i class="fas fa-map-marker-alt"></i> {{$tps->count()}} </h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Mendapatkan tanggal hari ini
        var today = new Date();

        // Mengatur tanggal target (14 Februari 2024)
        var targetDate = new Date('2024-02-14');

        // Menghitung selisih waktu dalam milidetik
        var timeDiff = targetDate - today;

        // Menghitung selisih hari
        var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        // Memperbarui teks badge dengan jumlah hari
        document.querySelector('.badge p').innerText = daysDiff + ' Hari Menuju Pemilu';
    </script>
@endsection
