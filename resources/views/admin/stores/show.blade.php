@extends('layouts.app')

@section('title')
    {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin::dashboard') }}">Dasbor Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin::stores::index') }}">Kelola Bisnis</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <h2>@yield('title')</h2>
        <div class="my-2 text-muted small">
            <span class="me-2">ID: {{ $store->id }}</span>
            <span class="me-2">Tanggal dibuat: {{ \Illuminate\Support\Carbon::simpleDatetime($store->created_at) }}</span>
            <span class="me-2">Terakhir diubah: {{ \Illuminate\Support\Carbon::simpleDatetime($store->updated_at) }}</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <dl>
                            <dt>Tipe Bisnis</dt>
                            <dd>{{ $store->type_name }}</dd>
                            <dt>Owner</dt>
                            <dd>
                                <a href="{{ route('admin::users::show', [$store->user]) }}">{{ $store->user->name }}</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

