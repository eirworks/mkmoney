@extends('layouts.app')

@section('title')
    Laporan Laba Rugi
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb justify-content-center d-print-none">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::index') }}">Bisnisku</a></li>
            <li class="breadcrumb-item"><a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <table class="d-none d-print-block">
            <tbody>
            <tr>
                <td style="width: 25%;">
                    <img style="width: 120px; height: 120px" class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($store->image) }}" alt="{{ $store->name }}">
                </td>
                <td style="width: 75%; padding-left: 40px;">
                    <h2>@yield('title')</h2>
                    <div class="my-3 h4">
                        {{ $store->name }}
                    </div>
                    <div class="my-3">
                        Periode {{ $start->format('d M Y') }}
                        &mdash; {{ $end->format('d M Y') }}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="d-block d-print-none">
            <h2 class="text-center">@yield('title')</h2>
            <div class="my-3 h4 text-center">
                {{ $store->name }}
            </div>
            <div class="my-3 text-center">
                Periode {{ $start->format('d M Y') }}
                &mdash; {{ $end->format('d M Y') }}
            </div>
        </div>

        <div class="my-3 text-center d-print-none">

        </div>

        <div class="my-3 text-center d-print-none">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="month" id="month" class="form-control">
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->localeMonth }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="year" id="year" class="form-control">
                                    @for($i=2010; $i<=now()->year; $i++)
                                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4 text-start">
                                <button class="btn btn-outline-primary">Filter</button>
                                <button class="btn btn-outline-secondary ms-3" onclick="window.print()">Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

                <div class="my-5 d-none d-print-block">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td style="width: 30%;">
                                <div class="border-bottom border-dark"></div>
                                <div class="my-5">&nbsp;</div>
                                <div class="border-bottom border-dark mt-5 pt-5"></div>
                                <div class="text-center mt-2">Bendahara</div>
                            </td>
                            <td>&nbsp;</td>
                            <td style="width: 30%">
                                <div class="border-bottom border-dark"></div>
                                <div class="my-5">&nbsp;</div>
                                <div class="border-bottom border-dark mt-5 pt-5"></div>
                                <div class="text-center mt-2">Pemilik {{ $store->name }}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

