@extends('layouts.app')

@section('title')
    {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2 class="d-print-none">@yield('title')</h2>
        <div class="my-2 text-muted small d-print-none">
            ID: #{{ $store->id }}
            Dibuat pada {{ \Illuminate\Support\Carbon::simpleDatetime($store->created_at) }}
            Terakhir diupdate: {{ \Illuminate\Support\Carbon::simpleDatetime($store->update_at) }}
        </div>

        <div class="my-3 d-print-none">
            <div class="btn-group">
                <a href="{{ route('stores::edit', [$store]) }}" class="btn btn-outline-secondary">Edit Bisnis</a>
                <a href="{{ route('stores::categories::index', [$store]) }}" class="btn btn-outline-secondary">Kategori</a>
                <a href="{{ route('stores::income::index', [$store]) }}" class="btn btn-outline-secondary">Pendapatan</a>
                <a href="{{ route('stores::reports::income', [$store]) }}" class="btn btn-outline-secondary">Laba Rugi</a>
            </div>
        </div>

        <div class="my-3 d-print-none">
            <livewire:transaction-input :store="$store" />
        </div>

        <div class="my-3">
            <livewire:transactions-table :store="$store" />
        </div>
    </div>
@endsection

