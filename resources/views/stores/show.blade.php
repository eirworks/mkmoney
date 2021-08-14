@extends('layouts.app')

@section('title')
    {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2 class="d-print-none">@yield('title')</h2>
        <div class="my-3 text-muted small d-print-none">
            ID: #{{ $store->id }}
            Dibuat pada {{ \Illuminate\Support\Carbon::simpleDatetime($store->created_at) }}
            Terakhir diupdate: {{ \Illuminate\Support\Carbon::simpleDatetime($store->update_at) }}
            <span class="mx-2">{{ $store->type_name }}</span>
        </div>

        <div class="row">
            <div class="col-md-3">
                <nav class="list-group">
                    <a href="{{ route('stores::edit', [$store]) }}" class="list-group-item">Edit Bisnis</a>
                    <a href="{{ route('stores::categories::index', [$store]) }}" class="list-group-item">Kategori</a>
                    <a href="{{ route('stores::income::index', [$store]) }}" class="list-group-item">Pendapatan</a>
                    <a href="{{ route('stores::expenditures::index', [$store]) }}" class="list-group-item">Pengeluaran</a>
                    <a href="{{ route('stores::reports::income', [$store]) }}" class="list-group-item">Laporan Laba Rugi</a>
                    <a href="{{ route('stores::journal::index', [$store]) }}" class="list-group-item">Jurnal</a>
                    <a href="{{ route('stores::ledger::index', [$store]) }}" class="list-group-item">Buku Besar</a>
                </nav>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <canvas id="expenditureChart"></canvas>
                    </div>
                    <div class="col-md-8">
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>
                <div class="my-3">
                    <livewire:my-current-store :store="$store" />
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.min.js" integrity="sha512-JxJpoAvmomz0MbIgw9mx+zZJLEvC6hIgQ6NcpFhVmbK1Uh5WynnRTTSGv3BTZMNBpPbocmdSJfldgV5lVnPtIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@push('bottom')
    <script>
        var ctx = document.getElementById('expenditureChart');
        var expenditureChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [{!! collect($categories)->map(function($cat) { return "'".$cat['category']->name."'"; })->join(',') !!}],
                datasets: [
                    {
                        label: "Perbandingan Pengeluaran",
                        data: [{!! collect($categories)->pluck('sum')->join(',') !!}],
                        backgroundColor: [{!! collect($categories)->map(function($cat) { return "'".$cat['color']."'"; })->join(',') !!}]
                    }
                ]
            }
        })
    </script>
@endpush

@push('bottom')
    <script>
        var ctx = document.getElementById('incomeChart');
        var incomeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [{!! collect($records)->map(function($record) { return "'".$record->date->format('d M')."'"; })->join(',') !!}],
                datasets: [
                    {
                        label: "Pemasukan {{ now()->startOfMonth()->month($month)->englishMonth }} {{ $year }}",
                        data: [{!! collect($records)->pluck('amount')->join(',') !!}],
                        backgroundColor: "rgba(138,148,191,0.56)",
                        borderColor: "rgba(138,148,191)",
                        fill: true,
                    }
                ]
            }
        })
    </script>
@endpush
