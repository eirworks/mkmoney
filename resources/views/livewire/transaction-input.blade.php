<div>
    <div class="card">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="Keterangan" wire:model.defer="info">
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <div class="input-group-text">Rp</div>
                        <input type="number" class="form-control" placeholder="Jumlah" wire:model.defer="amount">
                    </div>
                </div>
                <div class="col-auto">
                    <select name="category_id" id="category_id" class="form-control" wire:model.defer="category_id">
                        <option value="0">Pilih kategori:</option>
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}">Kategori {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" wire:click="submitTransaction">Tambahkan</button>
                </div>
                <div class="col-auto">
                    <div class="text-muted" wire:loading>Tunggu sebentar...</div>
                </div>
            </div>
        </div>
    </div>
</div>
