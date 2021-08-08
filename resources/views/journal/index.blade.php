@extends('layouts.app')

@section('title')
    Jurnal {{ $store->name }}
    {{ now()->month($month)->monthName }}
    {{ $year }}
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <h2 class="text-center">@yield('title')</h2>

        <div class="my-3 d-print-none">
            <form action="{{ route('stores::journal::index', [$store]) }}" method="get">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <select name="month" id="month" class="form-control">
                            @for($i=1;$i<=12; $i++)
                                <option value="{{ $i }}" {{ $i == $month ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->monthName }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="year" id="year" class="form-control">
                            @for($i=2010;$i<=now()->year; $i++)
                                <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-secondary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <table class="my-3 bg-white table">
            <thead>
            <tr>
                <th>Tanggal</th>
                <th>Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
            </thead>
            <tbody>
{{--            <tr class="bg-light">--}}
{{--                <td></td>--}}
{{--                <td>Modal</td>--}}
{{--                <td></td>--}}
{{--                <td>{{ Str::currency(($starting_balance), 'Rp') }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td></td>--}}
{{--                <td>Kas</td>--}}
{{--                <td>{{ Str::currency(($starting_balance), 'Rp') }}</td>--}}
{{--                <td></td>--}}
{{--            </tr>--}}
            @foreach($transactions as $transaction)
                <tr class="bg-light">
                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($transaction->amount > 0)
                            Kas
                        @else
                            Biaya
                        @endif
                    </td>
                    <td>
                        @if($transaction->amount > 0)
                        @else
                            {{ Str::currency(abs($transaction->amount), "Rp") }}
                        @endif
                    </td>
                    <td>
                        @if($transaction->amount > 0)
                            {{ Str::currency(abs($transaction->amount), "Rp") }}
                        @else
                        @endif
                    </td>
                </tr>
                <tr class="border-dark">
                    <td></td>
                    <td>
                        @if($transaction->amount > 0)
                            Pendapatan
                        @else
                            Kas
                        @endif
                    </td>
                    <td>
                        @if($transaction->amount > 0)
                            {{ Str::currency(abs($transaction->amount), "Rp") }}
                        @else
                        @endif
                    </td>
                    <td>
                        @if($transaction->amount > 0)
                        @else
                            {{ Str::currency(abs($transaction->amount), "Rp") }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

