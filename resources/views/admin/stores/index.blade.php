@extends('layouts.app')

@section('title')
    Kelola Bisnis
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin::dashboard') }}">Dasbor Admin</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>

        <div class="card my-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Bisnis</th>
                        <th>Tipe Bisnis</th>
                        <th>Owner</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stores as $store)
                        <tr>
                            <td>{{ $store->id }}</td>
                            <td><a href="{{ route('admin::stores::show', [$store]) }}">{{ $store->name }}</a></td>
                            <td>{{ $store->type_name }}</td>
                            <td><a href="{{ route('admin::users::show', [$store->user]) }}">{{ $store->user->name }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="my-3">
            {!! $stores->links() !!}
        </div>
    </div>
@endsection

