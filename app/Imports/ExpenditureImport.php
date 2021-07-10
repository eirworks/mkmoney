<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExpenditureImport implements ToModel, WithHeadingRow
{
    private int $storeId;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        debug($row);
        $category = $this->getOrCreateCategory($row['kategori'], $this->storeId);
        $trx = new Transaction([
            'purchased_at' => Date::excelToDateTimeObject($row['tanggal']),
            'shop' => $row['nama_toko'],
            'info' => $row['keterangan'],
            'amount' => $row['harga_satuan'],
            'qty' => $row['kuantitas'],
            'unit' => $row['satuan'],
            'category_id' => $category->id,
        ]);
        $trx->store_id = $this->storeId;
        return $trx;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    private function getOrCreateCategory($name, $storeId)
    {
        $store = Store::find($storeId);
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
