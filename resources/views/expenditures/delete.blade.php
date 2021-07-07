@extends('layouts.app')

@section('title')
    Hapus Transaksi {{ $store->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('stores::expenditures::delete::submit', [$store]) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">@yield('title')</div>
                        <div class="card-body">
                            Transaksi mana yang ingin anda hapus?
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="period" id="current_month" value="current_month" checked>
                                    <label for="current_month">Bulan ini ({{ now()->monthName }} {{ now()->year }})</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="period" id="selected_month" value="selected_month">
                                    <label for="selected_month">Bulan Terpilih:</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <select name="month" id="month" class="form-control">
                                                @for($i=1;$i<=12; $i++)
                                                    <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->monthName }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select name="year" id="year" class="form-control">
                                                @for($i=2010;$i<=now()->year; $i++)
                                                    <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="period" id="all" value="all">
                                    <label for="all">Semua Transaksi</label>
                                </div>
                            </div>
                            <div class="my-3 text-muted">
                                Apakah anda benar-benar yakin ingin menghapus transaksi ini?
                                Transaksi yang dihapus tidak dapat dikembalikan lagi.
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <button class="btn btn-danger">Hapus Transaksi</button>
                            <a href="{{ route('stores::expenditures::index', [$store]) }}" class="btn btn-link text-muted ms-3">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

