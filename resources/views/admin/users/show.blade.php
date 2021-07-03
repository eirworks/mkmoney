@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin::dashboard') }}">Dasbor Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin::users::index') }}">Kelola Pengguna</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="my-1 text-muted small">
            <span class="me-2">ID: {{ $user->id }}</span>
            <span class="me-2">Tanggal pendaftaran: {{ \Illuminate\Support\Carbon::simpleDatetime($user->created_at) }}</span>
            <span class="me-2">Terakhir diubah: {{ \Illuminate\Support\Carbon::simpleDatetime($user->updated_at) }}</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-body">
                        <dl>
                            <dt>Email</dt>
                            <dd>{{ $user->email }}</dd>
                            <dt>Kewenangan</dt>
                            <dd>{{ $user->role_name }}</dd>
                            <dt>Bisnisku</dt>
                            <dd>
                                {{ $user->stores_count }}
                                <a href="{{ route('admin::stores::index', ['user_id' => $user->id]) }}" class="mx-2">Kelola Bisnis</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

