@extends('template')
@section('title')
    <title>Sikasiduk - Klasifikasi Penduduk</title>
@endsection

@section('header')
    <h1>
        Klasifikasi Penduduk
    </h1>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
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

            <div class="card">
                <div class="card-header">
                    <h4>Proses Klasifikasi Penduduk</h4>
                    <a href="{{ route('create-klasifikasi') }}" class="btn btn-success ml-auto">Tambah Klasifikasi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai K</th>
                                    <th>Nama Panitia</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Dibuat Pada</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nilai_k }}</td>
                                        <td>Najib</td>
                                        <td>{{ $item->file }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge badge-warning">Belum Proses</span>
                                            @else
                                                <span class="badge badge-info">Sudah di Proses</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a href="{{ route('detail-klasifikasi', ['id' => $item->id]) }}"
                                                    class="btn btn-primary">Proses</a>
                                                <form action="{{ route('delete-klasifikasi', ['id' => $item->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            @else
                                                <a href="{{ route('detail-klasifikasi', ['id' => $item->id]) }}"
                                                    class="btn btn-primary">Lihat</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/modules-datatables.js') }}"></script>
@endsection
