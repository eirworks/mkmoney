@extends('layouts.app')

@section('title')
    Hapus Kategori {{ $category->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>@yield('title')</h3>
                <form action="{{ route('stores::categories::confirmDestroy', [$store, $category]) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="card my-3 border-danger">
                        <div class="card-body">
                            <div class="mb-3">
                                Anda yakin ingin menghapus
                                <strong>{{ $category->name }}</strong>
                                dari <a href="{{ route('stores::show', [$store]) }}">{{ $store->name }}</a>?
                            </div>
                            <div class="mb-3">
                                Kategori ini memiliki {{ $category->transactions_count }} transaksi.
                                Apa yang harus dilakukan pada transaksi-transaksi tersebut?
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="radio" name="delete_effect" checked value="delete_transactions" class="form-check-input" id="delete_effect_delete_transactions">
                                    <label for="delete_effect_delete_transactions">Hapus semua transaksi dalam kategori ini</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="delete_effect" value="move_transactions" class="form-check-input" id="delete_effect_move_transactions">
                                    <label for="delete_effect_move_transactions">Pindahkan semua transaksi ke kategori lain</label>
                                    <div class="my-2">
                                        <select class="form-control" name="category_target" id="category_target">
                                            @foreach($other_categories as $other_category)
                                                <option value="{{ $other_category->id }}">{{ $other_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger text-white">
                            <button class="btn btn-warning border-white bg-white text-danger fw-bold">Hapus Kategori</button>
                            <a href="{{ route('stores::categories::show', [$store, $category]) }}" class="btn btn-link text-white">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

