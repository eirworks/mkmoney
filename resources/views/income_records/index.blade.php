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

                <div class="my-3">
                    <div class="btn-group">
                        <button class="btn btn-primary">Tambah Transaksi</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary">Filter</button>
                    </div>
                </div>

                <div class="my-3 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="day" id="day" class="form-control">
                                    @for($i=1;$i<=31;$i++)<option value="{{ $i }}" {{ now()->day == $i ? 'selected' : "" }}>{{ $i }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="month" id="month" class="form-control">
                                    @for($i=1;$i<=12;$i++)<option value="{{ $i }}" {{ $month == $i ? 'selected' : "" }}>{{ now()->startOfMonth()->month($i)->localeMonth }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    @for($i=2010;$i<=now()->year;$i++)<option value="{{ $i }}" {{ $year == $i ? 'selected' : "" }}>{{ $i }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-md-12 my-3">
                                <div class="input-group">
                                    <div class="input-group-text">Rp</div>
                                    <input type="number" class="form-control" name="amount" placeholder="Jumlah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Tambahkan</button>
                    </div>
                </div>

                <div class="my-3 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="month" id="month" class="form-control">
                                    @for($i=1;$i<=12;$i++)<option value="{{ $i }}" {{ $month == $i ? 'selected' : "" }}>{{ now()->startOfMonth()->month($i)->localeMonth }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    @for($i=2010;$i<=now()->year;$i++)<option value="{{ $i }}" {{ $year == $i ? 'selected' : "" }}>{{ $i }}</option>@endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-secondary">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>

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
            </div>
        </div>
    </div>
@endsection

