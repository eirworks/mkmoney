<div>
    <div class="my-3 row">
        <div class="col-md-3">
            <select name="month" id="month" class="form-control" wire:model.defer="month">
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}">{{ now()->month($i)->monthName }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <select name="year" id="year" class="form-control" wire:model.defer="year">
                @for($i=2010;$i<=now()->year;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" wire:click="$refresh()">Filter</button>
        </div>
    </div>
    <div wire:loading wire:loading.block>
        <div class="text-center text-muted">Tunggu sebentar...</div>
    </div>
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th>Tanggal</th>
                <th class="text-end">Debit</th>
                <th class="text-end">Kredit</th>
            </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                        @if($selected=='cash')
                            <td class="text-end" title="{{ $transaction->amount }}">@if($transaction->amount > 0){{ Str::currency(abs($transaction->amount), "Rp") }}@endif</td>
                            <td class="text-end" title="{{ $transaction->amount }}">@if($transaction->amount <= 0){{ Str::currency(abs($transaction->amount), "Rp") }}@endif</td>
                        @else
                            @if($transaction->amount > 0)<td></td>@endif
                            <td class="text-end" title="{{ $transaction->amount }}">{{ Str::currency(abs($transaction->amount), "Rp") }}</td>
                            @if($transaction->amount <= 0)<td></td>@endif
                        @endif
                    </tr>
                @endforeach
            <tr class="fw-bold">
                <td class="text-end">Total</td>
                <td colspan="2" class="text-end">{{ Str::currency(abs($total), "Rp") }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
