@extends('layouts.app')

@section('title')
    Upload Rekap Pendapatan
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::income::index', [$store]) }}">Pemasukan</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('stores::income::storeCsv', [$store]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="file" name="csv" class="form-control">
                            </div>
                            <div class="text-muted small">
                                File harus berformat Excel, Open Document Sheet, atau CSV, maksimal 2MB.
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

