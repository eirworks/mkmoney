@extends('layouts.frontend')

@section('title')
    Lupa Kata Sandi?
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header text-center">
                        Lupa kata sandi?
                    </div>
                    <div class="card-body">
                        Untuk me-reset kata sandi anda, silakan hubungi
                        <a href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</a> atau via Whasapp
                        di
                        <a href="https://wa.me/{{ $settings['contact_wa'] }}">{{ $settings['contact_wa'] }}</a>
                    </div>
                </div>
                <div class="my-5 text-center">
                    <a href="{{ route('auth::login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection

