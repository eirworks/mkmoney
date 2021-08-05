@extends('layouts.app')

@section('title')
    Pendapatan {{ now()->startOfMonth()->month($month)->localeMonth }}
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

        <div class="row">
            <div class="col-md-12">
                <div class="my-3 d-print-none">
                    <livewire:transaction-input :store="$store" :day="now()->day" :month="$month" :year="$year" :expenditure="false" />
                </div>

                <livewire:transactions-table :store="$store" />
                <div class="my-3 text-muted text-center d-print-none"><button class="btn btn-outline-secondary" onclick="window.print()">Cetak</button></div>
            </div>
        </div>
    </div>
@endsection

