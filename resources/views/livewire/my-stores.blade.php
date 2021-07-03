<div wire:init="getMyStores">
    <div wire:loading.block class="text-muted text-center">Mengambil data...</div>
    <div class="row">
        @foreach($stores as $store)
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h5 fw-normal">{{ $store['name'] }}</div>
                        <div>{{ $store['type_name'] }}</div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group">
                            <a href="{{ route('stores::show', [$store['id']]) }}" class="btn btn-link">Semua Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-3"><a href="{{ route('stores::index') }}">Lihat semua bisnisku</a></div>
</div>
