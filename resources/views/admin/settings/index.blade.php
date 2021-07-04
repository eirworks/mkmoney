@extends('layouts.app')

@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ route('admin::dashboard') }}">Dasbor Admin</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2 class="text-center">@yield('title')</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin::settings::update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body">
                            @foreach($settings as $setting)
                                <div class="mb-3">
                                    <label for="{{ $setting['key'] }}">{{ __('settings.'.$setting['key']) }}</label>
                                    @if($setting['type'] == 'bool')
                                        <input type="hidden" name="{{ $setting['key'] }}" value="0">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input id="{{ $setting['key'] }}" type="checkbox" name="{{ $setting['key'] }}" value="1" class="form-check-input">
                                            </label>
                                        </div>
                                    @else
                                        <input type="text" id="{{ $setting['key'] }}" name="{{ $setting['key'] }}" value="{{ $setting['value'] }}" class="form-control">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

