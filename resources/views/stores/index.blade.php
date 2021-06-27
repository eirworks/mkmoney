@extends('layouts.app')

@section('title')
    Bisnisku
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>

        <div class="my-3">
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Tambahkan Bisnis</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tipe Bisnis</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></td>
                        <td>{{ $store->type }}</td>
                        <td>
                            <div class="btn-group btn-sm">
                                <a href="#" class="btn btn-link py-0">Edit</a>
                                @if(auth()->user()->store_id != $store->id)
                                    <button form="set_default_{{ $store->id }}" class="btn btn-link py-0">Jadikan bisnis utama</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <form onsubmit="return confirm('Anda yakin ingin menjadikan bisnis ini menjadi bisnis utama anda?')" id="set_default_{{ $store->id }}" action="{{ route('stores::set-default', [$store]) }}" method="post">
                        @method('put')
                        @csrf
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-3">
            Anda telah menggunakan jatah bisnis {{ $store_count }}/{{ $max_stores }}
        </div>
    </div>
@endsection

