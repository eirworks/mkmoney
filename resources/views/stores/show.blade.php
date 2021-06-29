@extends('layouts.app')

@section('title')
    {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="my-2 text-muted small">
            ID: #{{ $store->id }}
            Dibuat pada {{ \Illuminate\Support\Carbon::simpleDatetime($store->created_at) }}
            Terakhir diupdate: {{ \Illuminate\Support\Carbon::simpleDatetime($store->update_at) }}
        </div>

        <div class="my-3">
            <div class="btn-group">
                <a href="{{ route('stores::edit', [$store]) }}" class="btn btn-outline-secondary">Edit Bisnis</a>
                <a href="#" class="btn btn-outline-secondary">Kategori</a>
            </div>
        </div>

        <div class="my-3">
            <livewire:transaction-input :store="$store" />
        </div>

        <div class="my-3">
            <livewire:transactions-table :store="$store" />
        </div>
    </div>
@endsection

