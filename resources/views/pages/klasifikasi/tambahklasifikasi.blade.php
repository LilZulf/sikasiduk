@extends('template')
@section('title')
    <title>Sikasiduk - Tambah Data Klasifikasi</title>
@endsection

@section('header')
    <h1>
        Tambah Data Klasifikasi
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Klasifikasi</a></div>
        <div class="breadcrumb-item">Tambah Data Klasifikasi</div>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-12 mb-4">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Formulir data Klasifikasi</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('post-klasifikasi')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nilai_k">Nilai K</label>
                            <input type="number" class="form-control" id="nilai_k" name="nilai_k" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
