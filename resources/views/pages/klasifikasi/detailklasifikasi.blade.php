@extends('template')
@section('title')
    <title>Sikasiduk - Detail Klasifikasi</title>
@endsection

@section('header')
    <h1>
        Detail Klasifikasi
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Klasifikasi</a></div>
        <div class="breadcrumb-item">Detail Klasifikasi</div>
    </div>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
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
                    <h4>Nilai K</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-klasifikasi') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nilai_k">Nilai K</label>
                            <input type="number" class="form-control" id="nilai_k" value="{{ $proses->nilai_k }}"
                                name="nilai_k" readonly>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Masukkan Data Testing</h4>
                </div>
                <div class="card-body">
                    <!-- Form dengan dropdown -->
                    @if ($proses->status == 0)
                        <form action="{{ route('post-testing', ['id_proses' => $proses->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="id_penduduk">Pilih Penduduk:</label>
                                <select name="id_penduduk" id="id_penduduk2" class="form-control select2">
                                    @foreach ($penduduk as $person)
                                        <option value="{{ $person->id }}">{{ $person->id }}. {{ $person->nama }} -
                                            {{ $person->rt }},
                                            {{ $person->rw }}, {{ $person->id_alamat }} </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($penduduk->count() > 0)
                                <button type="submit" class="btn btn-primary">Simpan Data Testing</button>
                            @endif
                        </form>
                    @endif
                    <hr>
                    <!-- Tabel Data Testing -->
                    <h4>Data Testing:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID penduduk</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>ID Alamat</th>
                                    @if ($proses->status == 0)
                                        <th>Action</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testing as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id_penduduk }}</td>
                                        <td>{{ $item->rt }}</td>
                                        <td>{{ $item->rw }}</td>
                                        <td>{{ $item->id_alamat }}</td>
                                        @if ($proses->status == 0)
                                            <td>
                                                <form action="{{ route('delete-testing', ['id' => $item->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id_proses" value="{{ $proses->id }}">
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Masukkan Data Training</h4>
                </div>
                <div class="card-body">
                    <!-- Form dengan dropdown -->
                    @if ($proses->status == 0)
                        <form action="{{ route('post-training', ['id_proses' => $proses->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="id_penduduk">Pilih Penduduk:</label>
                                <select name="id_penduduk" id="id_penduduk1" class="form-control select2" id="training">
                                    @foreach ($penduduk as $person)
                                        <option value="{{ $person->id }}">{{ $person->id }}. {{ $person->nama }} -
                                            {{ $person->rt }},
                                            {{ $person->rw }}, {{ $person->id_alamat }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_random">Jika Random Masukkan Jumlah Data</label>
                                <input type="number" class="form-control" id="jumlah_random" name="jumlah_random">
                            </div>
                            @if ($penduduk->count() > 0)
                                <button type="submit" class="btn btn-primary">Simpan Data Training</button>
                                <button type="submit" name="select_all" value="1" class="btn btn-success">Pilih Semua
                                    Penduduk</button>
                                <button type="submit" name="select_random" value="1" class="btn btn-warning">Pilih
                                    Random</button>
                            @endif
                        </form>
                    @else
                        <div></div>
                    @endif

                    <hr>
                    <!-- Tabel Data Training -->
                    <h4>Data Training:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID penduduk</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>ID Alamat</th>
                                    <th>TPS</th>
                                    @if ($proses->status == 0)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($training as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id_penduduk }}</td>
                                        <td>{{ $item->rt }}</td>
                                        <td>{{ $item->rw }}</td>
                                        <td>{{ $item->id_alamat }}</td>
                                        <td>{{ $item->tps }}</td>
                                        @if ($proses->status == 0)
                                            <td>
                                                <form action="{{ route('delete-training', ['id' => $item->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id_proses" value="{{ $proses->id }}">
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Klasifikasi KNN</h4>
                </div>
                <div class="card-body">
                    @if ($proses->status == 0)
                        <form action="{{ route('post-prediksi', ['id_proses' => $proses->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Proses Klasifikasi</button>
                        </form>
                    @endif

                    <hr>
                    <!-- Tabel Data Testing -->
                    <h4>Hasil Klasifikasi:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID penduduk</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>ID Alamat</th>
                                    <th>TPS Prediksi</th>
                                    <th>TPS Asli</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prediksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id_penduduk }}</td>
                                        <td>{{ $item->rt }}</td>
                                        <td>{{ $item->rw }}</td>
                                        <td>{{ $item->id_alamat }}</td>
                                        <td>{{ $item->prediksi }}</td>
                                        <td>{{ $item->tps }}</td>
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
    <script src="{{ asset('stisla/assets/js/page/modules-datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table.table').DataTable();

        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('.select2').select2();
        });
    </script>
@endsection
