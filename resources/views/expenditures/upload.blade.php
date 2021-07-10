@extends('layouts.app')

@section('title')
    Upload Pengeluaran
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::expenditures::index', [$store]) }}">Laporan Pengeluaran</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('stores::expenditures::storeCsv', [$store]) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="file" name="csv" class="form-control">
                            </div>
                            <div class="text-muted">
                                File harus berformat Excel atau CSV, maksimal 2MB.
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

