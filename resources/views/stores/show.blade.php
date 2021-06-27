@extends('layouts.app')

@section('title')
    {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
    </div>
@endsection

