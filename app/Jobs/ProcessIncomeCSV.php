<?php

namespace App\Jobs;

use App\Models\IncomeRecord;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessIncomeCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filename;
    private Store $store;
    private int $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filename, Store $store, int $userId)
    {
        $this->filename = $filename;
        $this->store = $store;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = \Storage::get($this->filename);
        collect(explode("\n", $content))
            ->reject(function($line) { return empty($line);})
            ->map(function($line) { return str_getcsv($line); })
            ->each(function($line) {
                $date = Carbon::parse($line[0]);
                $existingDate = IncomeRecord::where('store_id', $this->store->id)
                    ->where('date', '=', $date)
                    ->first();

                if ($existingDate) {
                    \Log::debug("Existing #".$existingDate->id);
                    $existingDate->amount = $line[1];
                    $existingDate->save();
                } else {
                    $existingDate = new IncomeRecord([
                        'date' => $date,
                        'amount' => $line[1],
                    ]);
                    $existingDate->store_id = $this->store->id;
                    $existingDate->user_id = $this->userId;
                    $existingDate->save();
                }
                \Log::debug("Saved income record #".$existingDate->id);
            });
    }
}
