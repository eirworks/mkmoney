@extends('layouts.app')

@section('title')
    Rekapitulasi Omzet Pendapatan {{ now()->startOfMonth()->month($month)->localeMonth }}
    {{ $year }}
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <livewire:income-record-form :store="$store" :day="now()->day" :month="$month" :year="$year" />

                <div class="bg-white table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Illuminate\Support\Carbon::simpleDate($record->date) }}</td>
                                <td class="text-end">{{ \Illuminate\Support\Str::currency($record->amount, 'Rp') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="fw-bold text-end">Total</td>
                            <td class="fw-bold text-end">{{ \Illuminate\Support\Str::currency($records->sum('amount'), 'Rp') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-3 text-muted text-center small">
                    Untuk mengubah transaksi, pilih tanggal dari transaksi yang ingin diubah pada form diatas.
                </div>
            </div>
        </div>
    </div>
@endsection

