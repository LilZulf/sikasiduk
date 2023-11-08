@extends('template')
@section('title')
    <title>Sikasiduk - Data TPS</title>
@endsection

@section('header')
    <h1>
        Data TPS
    </h1>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('body')
    <a href="{{ route('create-tps') }}" class="btn btn-icon icon-left btn-outline-success mb-4 text-success">
        <i class="fas fa-plus"></i>
        Tambah TPS
    </a>
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
    <div class="row">
        @foreach ($datas as $item)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('storage/' . $item->foto) }}">
                        </div>
                        <div class="article-badge">
                            <a href="{{ route('delete-tps', ['id' => $item->tps]) }}" class="article-badge-item bg-danger">
                                <i class="fas fa-trash"></i>Hapus
                            </a>
                        </div>
                    </div>
                    <div class="article-details">
                        <div class="article-title">
                            <h2><a href="{{ route('edit-tps', ['id' => $item->tps]) }}">{{ $item->nama_tps }}</a></h2>
                        </div>
                        <p>{{ $item->alamat }}</p>
                        <div class="article-cta">
                            <a href="{{ route('edit-tps', ['id' => $item->tps]) }}">Detail TPS <i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/modules-datatables.js') }}"></script>
@endsection
