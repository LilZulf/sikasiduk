@extends('template')
@section('title')
    <title>Sikasiduk - Edit Data Users</title>
@endsection

@section('header')
    <h1>
        Edit Data Users
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Users</a></div>
        <div class="breadcrumb-item">Edit Data Users</div>
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
                    <h4>Formulir data Users</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update-users', $user->id) }}">
                        @csrf
                        @method('PUT') <!-- Use the PUT method for update -->

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input id="nama" type="text" class="form-control" name="name"
                                value="{{ old('name', $user->name) }}" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" class="form-control pwstrength"
                                    data-indicator="pwindicator" name="password"
                                    placeholder="Leave blank to keep the current password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="level">Level</label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="level" value="0"
                                        {{ old('level', $user->level) == '0' ? 'checked' : '' }}> Admin
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" value="1"
                                        {{ old('level', $user->level) == '1' ? 'checked' : '' }}> Auditor
                                </label>
                                <!-- Add more radio buttons as needed -->
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
