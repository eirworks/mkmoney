@extends('layouts.app')

@section('title')
    Dasbor Admin
@endsection

@section('content')
    <div class="container">
        <div class="mb-2">
            Selamat datang di Dasbor Admin, {{ auth()->user()->name }}
            <span class="mx-2"><a href="{{ route('dashboard') }}">Kembali ke dasbor pengguna</a>.</span>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    @foreach($menus as $menu)
                        <a href="{{ $menu['url'] }}" class="list-group-item">{{ $menu['name'] }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-10">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <livewire:admin-stats stat="{{ \App\Models\Store::class }}" />
                    </div>
                    <div class="col-md-4">
                        <livewire:admin-stats stat="" />
                    </div>
                    <div class="col-md-4">
                        <livewire:admin-stats stat="{{ \App\Models\Transaction::class }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">List Bisnis terbaru</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nama Bisnis</th>
                                    <th>Transaksi</th>
                                    <th>Tgl Daftar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stores as $store)
                                    <tr>
                                        <td><a href="{{ route('admin::stores::show', [$store]) }}">{{ $store->name }}</a></td>
                                        <td>{{ $store->transactions_count }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::simpleDate($store->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <a href="{{ route('admin::stores::index') }}">Semua Bisnis</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">List Akun terbaru</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Bisnis</th>
                                    <th>Tgl Daftar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><a href="{{ route('admin::users::show', [$user]) }}">{{ $user->name }}</a></td>
                                        <td>{{ $user->stores_count }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::simpleDate($user->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <a href="{{ route('admin::users::index') }}">Semua Pengguna</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

