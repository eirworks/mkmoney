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
                        <td><a href="#">{{ $store->name }}</a></td>
                        <td>{{ $store->type }}</td>
                        <td>
                            <div class="btn-group btn-sm">
                                <a href="#" class="btn btn-link py-0">Edit</a>
                                <a href="#" class="btn btn-link py-0">Transaksi</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

