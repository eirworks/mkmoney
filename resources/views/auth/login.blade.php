@extends('layouts.frontend')

@section('title')
    Masuk ke akun anda
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <form action="{{ route('auth::login::submit') }}" method="post">
                    @csrf
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white text-center">Masuk</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="email">Alamat Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-primary btn-lg">Masuk</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="my-5 text-center">
                    <a href="{{ route('auth::register') }}">Belum punya akun?</a>
                </div>

                <div class="my-5 text-center">
                    <a href="{{ route('auth::forgot-password') }}">Lupa kata sandi?</a>
                </div>
            </div>
        </div>
    </div>
@endsection

