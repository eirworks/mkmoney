@extends('layouts.app')

@section('title')
    Dasbor
@endsection

@section('content')
    <div class="container">
        <div class="my-3">
            Selamat datang, {{ auth()->user()->name }}
        </div>
        <div class="mb-3">
            <livewire:my-current-store show-links header />
        </div>
        <div class="my-3">
            <h3>Bisnisku</h3>
            <livewire:my-stores :limit="5" />
        </div>
    </div>
@endsection

