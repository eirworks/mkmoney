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
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Tambah Kategori</button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('stores::categories::store', [$store]) }}" class="dropdown-item">Kategori Pemasukan</a>
                            <a href="{{ route('stores::categories::store', [$store, 'type' => 'expenditure']) }}" class="dropdown-item">Kategori Pengeluaran</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-group">
                <a class="btn btn-outline-secondary" href="{{ route('stores::categories::index', [$store]) }}">Semua</a>
                <a class="btn btn-outline-secondary" href="{{ route('stores::categories::index', [$store, 'type' => 'income']) }}">Pemasukan</a>
                <a class="btn btn-outline-secondary" href="{{ route('stores::categories::index', [$store, 'type' => 'expenditure']) }}">Pengeluaran</a>
            </div>
        </div>

        <div class="bg-white table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Sub Kategori dari</th>
                    <th>Tipe Kategori</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <span style="color: {{ $category->color ?? 'blue' }};">&#9679;</span>
                            <a class="{{ $category->parent_id == 0 ? 'fw-bold' : '' }}" href="{{ route('stores::categories::show', [$store, $category]) }}">{{ $category->name }}</a>
                        </td>
                        <td>
                            @if($category->parent_id > 0)
                                <a href="{{ route('stores::categories::show', [$store, $category->parent_id]) }}">{{ $category->parent->name }}</a>
                            @endif
                        </td>
                        <td>
                            @if($category->is_expenditure)
                                Pengeluaran
                            @else
                                Pemasukan
                            @endif
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

