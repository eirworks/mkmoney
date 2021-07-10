<?php

namespace App\Jobs;

use App\Imports\ExpenditureImport;
use App\Models\Category;
use App\Models\Store;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessExpenditureCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filename;
    private Store $store;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filename, Store $store)
    {
        $this->filename = $filename;
        $this->store = $store;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $content = \Storage::get($this->filename);
        $import = new ExpenditureImport();
        $import->setStoreId($this->store->id);
        Excel::import($import, $this->filename);

//        collect(explode("\n", $content))
//            ->reject(function($line) { return empty($line);})
//            ->map(function($line) { return str_getcsv($line); })
//            ->each(function($line) {
//                \Log::debug("Line", [$line]);
//
//                $category = $this->getOrCreateCategory($line[6], $this->store);
//
//                $trx = new Transaction([
//                    'created_at' => $line[0],
//                    'shop' => $line[1],
//                    'info' => $line[2],
//                    'amount' => $line[3],
//                    'qty' => $line[4],
//                    'unit' => $line[5],
//                    'category_id' => $category->id,
//                ]);
//                $trx->store_id = $this->store->id;
//                $trx->save();
//
//                \Log::debug("Added transaction ".$trx->id);
//            });

    }

    private function getOrCreateCategory($name, Store $store)
    {
        $cat = $store->categories()->whereName($name)->first();

        if (!$cat) {
            \Log::debug("Create new category named $name");
            $cat = new Category([
                'name' => $name,
                'description' => "Kategori $name"
            ]);
            $cat->store_id = $store->id;
            $cat->save();
        }

        return $cat;
    }
}
