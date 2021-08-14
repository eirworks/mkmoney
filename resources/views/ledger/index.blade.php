@extends('layouts.app')

@section('title')
    Buku Besar {{ $store->name }}
    {{ now()->month($month)->monthName }}
    {{ $year }}
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
        <div class="my-3">
            <livewire:ledger-nav :types="$types" />
        </div>
        <div class="my-3">
            <livewire:ledger-table :store="$store" :types="$types" />
        </div>
    </div>
@endsection

