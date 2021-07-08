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

                <form action="{{ $store->id ? route('stores::update', [$store]) : route('stores::store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if($store->id)
                        @method('put')
                    @endif

                    <div class="mb-3">
                        <label for="name">Nama Bisnis</label>
                        <input type="text" name="name" dusk="name" class="form-control" placeholder="Nama usaha anda" value="{{ $store->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="name">Bentuk usaha</label>
                        <select name="type" id="type" dusk="type" class="form-control">
                            @foreach(\App\Models\Store::types() as $type => $name)
                                <option value="{{ $type }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Alamat Email</label>
                        <input type="email" name="email" dusk="email" class="form-control" placeholder="Email" value="{{ $store->email }}">
                    </div>

                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="tel" name="phone" dusk="phone" class="form-control" placeholder="No Hp" value="{{ $store->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="name">Alamat</label>
                        <input type="text" name="address" dusk="address" class="form-control" placeholder="Alamat" value="{{ $store->address }}">
                    </div>

                    <div class="mb-3">
                        <label for="name">Logo</label>
                        @if($store->image)
                            <div class="my-2">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($store->image) }}"
                                     alt="Gambar {{ $store->name }}">
                            </div>
                        @endif
                        <input type="file" name="image" dusk="image" class="form-control">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" dusk="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

