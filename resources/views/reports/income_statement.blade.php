@extends('layouts.app')

@section('title')
    Laporan Laba Rugi
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">@yield('title')</h2>
        <div class="my-3 h4 text-center">
            {{ $store->name }}
        </div>
        <div class="my-3 text-center">
            Tanggal {{ \Illuminate\Support\Carbon::simpleDate(now()) }}
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Omset Pendapatan Kafe</td>
                        <td></td>
                        <td class="text-end text-success">{{ \Illuminate\Support\Str::currency($income, 'Rp') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="fw-bold">Biaya Operasional:</td>
                    </tr>
                    @foreach($categories as $cat)
                    <tr>
                        <td>{{ $cat['category']->name }}</td>
                        <td class="text-end">{{ \Illuminate\Support\Str::currency($cat['sum'], 'Rp') }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="fw-bold">Total Biaya Operasional</td>
                        <td></td>
                        <td class="text-end text-danger">{{ \Illuminate\Support\Str::currency(collect($categories)->sum('sum') * -1, 'Rp') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fw-bold text-end">Total</td>
                        <td class="text-end fw-bold text-{{ $total > 0 ? 'success' : 'danger' }}">{{ \Illuminate\Support\Str::currency($total, 'Rp') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
