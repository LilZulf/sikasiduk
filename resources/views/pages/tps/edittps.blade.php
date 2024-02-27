@extends('template')
@section('title')
    <title>Sikasiduk - Edit Data TPS</title>
@endsection

@section('header')
    <h1>
        Edit Data TPS
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('tps') }}">Data TPS</a></div>
        <div class="breadcrumb-item">Edit Data TPS</div>
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
                    <h4>Formulir data TPS</h4>
                </div>
                <div class="card-body">
                    @if ($data->status == 2)
                        <form action="{{ route('update-tps', ['id' => $data->tps]) }}" method="post"
                            onsubmit="return validateForm()" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto TPS" class="img-thumbnail">
                            <div class="form-group">
                                <label for="nama_tps">Nomer TPS:</label>
                                <input type="number" class="form-control" id="tps" value="{{ $data->tps }}"
                                    name="tps" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_tps">Nama TPS:</label>
                                <input type="text" class="form-control" id="nama_tps" value="{{ $data->nama_tps }}"
                                    name="nama_tps" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" value="{{ $data->alamat }}"
                                    name="alamat" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rt">RT:</label>
                                <input type="number" class="form-control" id="rt" value="{{ $data->rt }}"
                                    name="rt" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rw">RW:</label>
                                <input type="number" class="form-control" id="rw" value="{{ $data->rw }}"
                                    name="rw" readonly>
                            </div>
                            <div class="form-group">
                                <label for="long">Longitude:</label>
                                <input type="text" class="form-control" id="long" value="{{ $data->long }}"
                                    name="long" readonly>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" value="{{ $data->lat }}"
                                    name="latitude" readonly>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('update-tps', ['id' => $data->tps]) }}" method="post"
                            onsubmit="return validateForm()" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto TPS" class="img-thumbnail">
                            <div class="form-group">
                                <label for="nama_tps">Nomer TPS:</label>
                                <input type="number" class="form-control" id="tps" value="{{ $data->tps }}"
                                    name="tps" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_tps">Nama TPS:</label>
                                <input type="text" class="form-control" id="nama_tps" value="{{ $data->nama_tps }}"
                                    name="nama_tps" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" value="{{ $data->alamat }}"
                                    name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="rt">RT:</label>
                                <input type="number" class="form-control" id="rt" value="{{ $data->rt }}"
                                    name="rt" required>
                            </div>
                            <div class="form-group">
                                <label for="rw">RW:</label>
                                <input type="number" class="form-control" id="rw" value="{{ $data->rw }}"
                                    name="rw" required>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto TPS</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                            </div>
                            <div class="form-group">
                                <label for="long">Longitude:</label>
                                <input type="text" class="form-control" id="long" value="{{ $data->long }}"
                                    name="long">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" value="{{ $data->lat }}"
                                    name="latitude">
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function validateForm() {
            // Validasi nama_tps: mengubah nama_tps menjadi huruf besar
            var namaInput = document.getElementById('nama_tps');
            namaInput.value = namaInput.value.toUpperCase();

            // Validasi alamat: memeriksa apakah alamat mengandung simbol
            var alamatInput = document.getElementById('alamat');
            alamatInput.value = alamatInput.value.toUpperCase();
            alamatInput.value = alamatInput.value.replace(/[^a-zA-Z0-9\s]/g, '');

            return true; // Mengizinkan pengiriman formulir jika validasi berhasil
        }
    </script>
@endsection
