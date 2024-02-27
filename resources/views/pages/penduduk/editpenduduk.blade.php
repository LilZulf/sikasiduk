@extends('template')
@section('title')
    <title>Sikasiduk - Edit Data Penduduk</title>
@endsection

@section('header')
    <h1>
        Edit Data Penduduk
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Penduduk</a></div>
        <div class="breadcrumb-item">Edit Data Penduduk</div>
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
                    <h4>Formulir data penduduk</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-penduduk', ['id' => $id]) }}" method="post"
                        onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="number" class="form-control" value="{{ $data->nik }}" id="nik"
                                name="nik" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" value="{{ $data->nama }}" id="nama"
                                name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" class="form-control" value="{{ $data->alamat }}" id="alamat"
                                name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="rt">RT:</label>
                            <input type="number" class="form-control" value="{{ $data->rt }}" id="rt"
                                name="rt" required>
                        </div>
                        <div class="form-group">
                            <label for="rw">RW:</label>
                            <input type="number" class="form-control" value="{{ $data->rw }}" id="rw"
                                name="rw" required>
                        </div>
                        <div class="form-group">
                            <label for="tps">TPS:</label>
                            <input type="text" class="form-control" value="{{ $data->tps }}" id="tps"
                                name="tps">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function validateForm() {
            // Validasi nama: mengubah nama menjadi huruf besar
            var namaInput = document.getElementById('nama');
            namaInput.value = namaInput.value.toUpperCase();

            // Validasi alamat: memeriksa apakah alamat mengandung simbol
            var alamatInput = document.getElementById('alamat');
            alamatInput.value = alamatInput.value.toUpperCase();
            alamatInput.value = alamatInput.value.replace(/[^a-zA-Z0-9\s]/g, '');

            return true; // Mengizinkan pengiriman formulir jika validasi berhasil
        }
    </script>
@endsection
