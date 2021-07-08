@extends('layouts.app')

@section('title')
    Kategori {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <h2>@yield('title')</h2>

        <div class="my-3">
            <div class="btn-group">
                <a href="{{ route('stores::categories::store', [$store]) }}" class="btn btn-primary">Tambah Kategori</a>
            </div>
        </div>

        <div class="bg-white table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <span style="color: {{ $category->color ?? 'blue' }};">&#9679;</span>
                            <a href="{{ route('stores::categories::show', [$store, $category]) }}">{{ $category->name }}</a>
                        </td>
                        <td class="text-muted">{{ $category->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-3">
            {!! $categories->links() !!}
        </div>
    </div>
@endsection

