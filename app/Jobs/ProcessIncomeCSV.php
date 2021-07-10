<?php

namespace App\Jobs;

use App\Imports\IncomeImport;
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
use Maatwebsite\Excel\Facades\Excel;

class ProcessIncomeCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filename;
    private Store $store;
    private int $userId;
    private string $delimiter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filename, Store $store, int $userId, $delimiter = ',')
    {
        $this->filename = $filename;
        $this->store = $store;
        $this->userId = $userId;
        $this->delimiter = $delimiter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $content = \Storage::get($this->filename);
        $importObject = new IncomeImport();
        $importObject->setStoreId($this->store->id);
        $importObject->setUserId($this->userId);
        Excel::import($importObject, $this->filename);

//        collect(explode("\n", $content))
//            ->reject(function($line) { return empty($line);})
//            ->map(function($line) { return str_getcsv($line, $this->delimiter); })
//            ->each(function($line) {
//                $date = Carbon::parse($line[0]);
//                $existingDate = IncomeRecord::where('store_id', $this->store->id)
//                    ->where('date', '=', $date)
//                    ->first();
//
//                if ($existingDate) {
//                    \Log::debug("Existing #".$existingDate->id);
//                    $existingDate->amount = $line[2];
//                    $existingDate->name = $line[1];
//                    $existingDate->save();
//                } else {
//                    $existingDate = new IncomeRecord([
//                        'date' => $date,
//                        'amount' => $line[2],
//                        'name' => $line[1],
//                    ]);
//                    $existingDate->store_id = $this->store->id;
//                    $existingDate->user_id = $this->userId;
//                    $existingDate->save();
//                }
//                \Log::debug("Saved income record #".$existingDate->id);
//            });
    }
}
