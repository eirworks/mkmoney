@extends('layouts.app')

@section('title')
    @if($category->id)
        Edit Kategori "{{ $category->name }}"
    @else
        Tambah Kategori
    @endif
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::categories::index', [$store]) }}">Kategori</a></li>
            @if($category->id)
                <li class="breadcrumb-item"><a href="{{ route('stores::categories::index', [$store, $category]) }}">{{ $category->name }}</a></li>
            @endif
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ $category->id ? route('stores::categories::update', [$store, $category]) : route('stores::categories::create', [$store]) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Nama Kategori</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="description">Deskripsi kategori</label>
                                <input type="text" id="description" class="form-control" name="description" value="{{ $category->description }}">
                            </div>
                            <div class="mb-3">
                                <label for="color" class="d-block">Warna</label>
                                <input type="color" id="color" class="form-control-color" name="color" value="{{ $category->color }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('stores::categories::index', [$store]) }}" class="btn btn-link">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
