@extends('layouts.app')

@section('title')
    {{ $store->id ? "Edit ".$store->name : "Tambahkan bisnis" }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            @if($store->id)
                <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            @endif
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">@yield('title')</h2>

                <form action="{{ $store->id ? route('stores::update', [$store]) : route('stores::store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name">Nama Bisnis</label>
                        <input type="text" class="form-control" placeholder="Nama usaha anda">
                    </div>

                    <div class="mb-3">
                        <label for="name">Bentuk usaha</label>
                        <select name="type" id="type" class="form-control">
                            @foreach(\App\Models\Store::types() as $type => $name)
                                <option value="{{ $type }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
