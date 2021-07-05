@extends('layouts.app')

@section('title')
    Dasbor
@endsection

@section('content')
    <div class="container">
        <div class="my-3">
            Selamat datang, {{ auth()->user()->name }}
        </div>
        @if(auth()->user()->currentStore)
            <div class="mb-3">
                <livewire:my-current-store :store="auth()->user()->currentStore" show-links header />
            </div>
        @endif
        <div class="my-3">
            <h3>Bisnisku</h3>
            <livewire:my-stores :limit="5" />
        </div>
    </div>
@endsection

