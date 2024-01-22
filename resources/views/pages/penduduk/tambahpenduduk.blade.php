@extends('template')
@section('title')
    <title>Sikasiduk - Tambah Data Penduduk</title>
@endsection

@section('header')
    <h1>
        Tambah Data Penduduk
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Penduduk</a></div>
        <div class="breadcrumb-item">Tambah Data Penduduk</div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/dropzone/dist/min/dropzone.min.css') }}">
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
            <div class="card">
                <div class="card-header">
                    <h4>Excel data penduduk</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-penduduk') }}" class="dropzone" id="mydropzone"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Formulir data penduduk</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-penduduk-single') }}" method="post" onsubmit="return validateForm()">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
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
                            <label for="tps">TPS:</label>
                            <input type="text" class="form-control" id="tps" name="tps">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('stisla/node_modules/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script>
        Dropzone.options.mydropzone = {
            maxFiles: 1, // Set the maximum number of files to 1

            init: function() {
                var myDropzone = this;

                this.on("addedfile", function() {
                    // Optionally, you can perform additional actions when a file is added
                    console.log('File Uploaded');
                });

                this.on("success", function(file, response) {
                    // The file was successfully uploaded, and the server responded.
                    // You can perform additional actions here.

                    // Access the success data (namaExcel) and log it
                    var namaExcel = response.success;
                    console.log('File Upload Successful. namaExcel:', namaExcel);
                    window.location.href = "{{ route('penduduk') }}";
                });
            }
        };
    </script>
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
