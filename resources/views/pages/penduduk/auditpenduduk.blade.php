@extends('template')
@section('title')
    <title>Sikasiduk - Data Penduduk</title>
@endsection

@section('header')
    <h1>
        Data Penduduk
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
                    <h4>Audit Data Penduduk</h4>
                    <a href="{{ route('audit-all-penduduk') }}" class="btn btn-success ml-auto">Audit Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>ID Alamat</th>
                                    <th>Rt</th>
                                    <th>Rw</th>
                                    <th>TPS</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->id_alamat }}</td>
                                        <td>{{ $data->rt }}</td>
                                        <td>{{ $data->rw }}</td>
                                        <td>{{ $data->tps }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <span class="badge badge-warning">Belum diolah</span>
                                            @elseif ($data->status == 1)
                                                <span class="badge badge-info">Sudah diolah</span>
                                            @elseif ($data->status == 2)
                                                <span class="badge badge-primary">Sudah Audit</span>
                                            @elseif ($data->status == 3)
                                                <span class="badge badge-success">Disetujui</span>
                                            @else
                                                <span class="badge badge-secondary">Undefined</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->status != 2)
                                                <a href="{{ route('audit-single-penduduk', ['id' => $data->id]) }}"
                                                    class="btn btn-primary">Audit</a>
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
