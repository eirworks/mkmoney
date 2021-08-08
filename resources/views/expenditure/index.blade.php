@extends('layouts.app')

@section('title')
    Pengeluaran {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>

        <div class="my-3 d-print-none">
            <livewire:transaction-input :store="$store" :expenditure="true" />
        </div>

        <div class="my-3">
            <livewire:transactions-table :store="$store" :expenditure="true" />
        </div>

        <div class="my-5">
            <a href="{{ route('stores::expenditures::delete', [$store]) }}" class="text-danger small">Hapus transaksi</a>
        </div>
    </div>
@endsection

