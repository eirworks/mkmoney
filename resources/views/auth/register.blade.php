@extends('layouts.frontend')

@section('title')
    Daftar Akun Baru
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="{{ route('auth::register::submit') }}" method="post">
                    @csrf
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white text-center">Daftar Akun</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" dusk="name" id="name" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email">Alamat Email</label>
                                <input type="email" dusk="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password">Kata Sandi</label>
                                <input type="password" dusk="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-primary btn-lg" dusk="register">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="my-5 text-center">
                    <a href="{{ route('auth::login') }}">Sudah punya akun?</a>
                </div>
            </div>
        </div>
    </div>
@endsection

