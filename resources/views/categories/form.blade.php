@extends('layouts.app')

@section('title')
    @if($category->id)
        Edit Kategori "{{ $category->name }}"
    @else
        Tambah Kategori {{ request()->input('type') == 'expenditure' ? 'Pengeluaran' : 'Pemasukan' }}
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
                    @if($category->id)
                        @method('put')
                    @endif
                    @csrf
                    <input type="hidden" id="expenditure" name="expenditure" value="{{ $category->is_expenditure ? '1' : '0' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="parent_id">Pilih Kategori Utama</label>
                                <select dusk="parent_id" name="parent_id" id="parent_id" class="form-control">
                                    <option {{ $category->parent_id == 0 ? 'selected' : '' }} value="0">- Tanpa Kategori Utama -</option>
                                    @foreach($parent_categories as $parent_category)
                                        <option {{ $category->parent_id == $parent_category->id ? 'selected' : '' }} value="{{ $parent_category->id }}">{{ $parent_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <button class="btn btn-primary" dusk="submit">Simpan</button>
                            <a href="{{ route('stores::categories::index', [$store]) }}" class="btn btn-link">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

