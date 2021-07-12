@extends('layouts.app')

@section('title')
    Profil {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <h3>@yield('title')</h3>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('profile::update') }}" method="post">
                    @csrf
                    <div class="card my-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Alamat Email</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Kata Sandi</label>
                                <input type="password" name="password" value="" class="form-control">
                                <div class="my-2 text-muted">
                                    Biarkan kosong jika anda tidak ingin mengganti kata sandi
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-link">Kembali ke dasbor</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

