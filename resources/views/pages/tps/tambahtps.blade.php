@extends('template')
@section('title')
    <title>Sikasiduk - Tambah Data TPS</title>
@endsection

@section('header')
    <h1>
        Tambah Data TPS
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data TPS</a></div>
        <div class="breadcrumb-item">Tambah Data TPS</div>
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
                    <form action="{{route('post-tps')}}" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_tps">Nomer TPS:</label>
                            <input type="number" class="form-control" id="tps" name="tps" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_tps">Nama TPS:</label>
                            <input type="text" class="form-control" id="nama_tps" name="nama_tps" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="rt">RT:</label>
                            <input type="number" class="form-control" id="rt" name="rt" required>
                        </div>
                        <div class="form-group">
                            <label for="rw">RW:</label>
                            <input type="number" class="form-control" id="rw" name="rw" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto TPS</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="long">Longitude:</label>
                            <input type="text" class="form-control" id="long" name="long">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude:</label>
                            <input type="text" class="form-control" id="lat" name="lat">
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
