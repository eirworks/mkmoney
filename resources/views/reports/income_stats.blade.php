@extends('layouts.app')

@section('title')
    Grafik Pemasukan {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2 class="text-center">@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-3">
                    <form action="" method="get">
                        <div class="row justify-content-center`">
                            <div class="col-md-3">
                                <select name="month" id="month" class="form-control">
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->localeMonth }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="year" id="year" class="form-control">
                                    @for($i=2010; $i<=now()->year; $i++)
                                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.min.js" integrity="sha512-JxJpoAvmomz0MbIgw9mx+zZJLEvC6hIgQ6NcpFhVmbK1Uh5WynnRTTSGv3BTZMNBpPbocmdSJfldgV5lVnPtIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@push('bottom')
    <script>
        var ctx = document.getElementById('chart');
        var chart = new Chart(ctx, {
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

