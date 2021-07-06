<div>

    <div class="my-3">
        <div class="btn-group">
            <button class="btn btn-primary" wire:click="$toggle('showForm')">Tambah Transaksi</button>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-secondary" wire:click="$toggle('showFilter')">Filter</button>
            <a href="{{ route('stores::reports::income::stat', [$store]) }}" class="btn btn-outline-secondary">Grafik</a>
            <a href="{{ route('stores::income::createCsv', [$store]) }}" class="btn btn-outline-secondary">Upload CSV</a>
        </div>
    </div>

    @if($showForm)
    <div class="my-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select name="day" id="day" class="form-control" wire:model.defer="day">
                        @for($i=1;$i<=31;$i++)<option value="{{ $i }}" {{ now()->day == $i ? 'selected' : "" }}>{{ $i }}</option>@endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="month" id="month" class="form-control" wire:model.defer="month">
                        @for($i=1;$i<=12;$i++)<option value="{{ $i }}" {{ $month == $i ? 'selected' : "" }}>{{ now()->startOfMonth()->month($i)->localeMonth }}</option>@endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="year" id="year" class="form-control" wire:model.defer="year">
                        @for($i=2010;$i<=now()->year;$i++)<option value="{{ $i }}" {{ $year == $i ? 'selected' : "" }}>{{ $i }}</option>@endfor
                    </select>
                </div>
                <div class="col-md-6 my-3">
                    <div class="input-group">
                        <div class="input-group-text">Rp</div>
                        <input type="number" min="0" class="form-control" name="amount" placeholder="Jumlah" wire:model.defer="amount">
                    </div>
                </div>
                <div class="col-md-6 my-3">
                    <input type="text" name="name" placeholder="Nama pencatat" class="form-control" wire:model.defer="name">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" wire:click="submitTransaction" wire:loading.attr="disabled">Simpan</button>
        </div>
    </div>
    @endif

    @if($showFilter)
        <form action="{{ route('stores::income::index', [$store]) }}">
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
                            <button class="btn btn-secondary" type="submit">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

</div>

@push('bottom')
    <script>
        Livewire.on('trxAdded', function() {
            alert("Transaksi telah disimpan!")
            window.location.reload()
        })
    </script>
@endpush
