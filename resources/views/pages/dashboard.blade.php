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
            <div class="hero text-white hero-bg-image"
                data-background="{{ asset('stisla/assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg') }}"
                style="background-image: url(&quot;{{ asset('stisla/assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg') }}&quot;);">
                <div class="hero-inner">
                    <h2>Selamat Datang, Champ!</h2>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, incidunt?</p>
                    <div class="mt-4">
                        <span class="badge badge-light"><p>100 Hari Menuju Pemilu</p></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
