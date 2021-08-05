@extends('layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::categories::index', [$store]) }}">Kategori</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2><span style="color: {{ $category->color ?? 'blue' }};">&#9679;</span> @yield('title')</h2>
        <div class="my-3 text-muted">
            @if($category->parent_id)
                <span class="me-2">Subkategori: <a href="{{ route('stores::categories::show', [$store, $category->parent_id]) }}">{{ $category->parent->name ?? "?" }}</a></span>
            @endif
            Dibuat pada {{ \Illuminate\Support\Carbon::simpleDatetime($category->created_at) }}
            <span class="mx-3">
                {{ $category->transactions_count }} transaksi dalam kategori ini
            </span>
        </div>
        <div class="my-3">
            {{ $category->description }}
        </div>
        <div class="my-3">
            <a href="{{ route('stores::categories::edit', [$store, $category]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('stores::categories::destroy', [$store, $category]) }}" class="btn btn-outline-danger">Hapus</a>
        </div>
    </div>
@endsection

