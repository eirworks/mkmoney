<?php

namespace App\Imports;

use App\Models\IncomeRecord;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IncomeImport implements ToModel, WithHeadingRow
{
    private int $storeId = 0;
    private int $userId = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = Carbon::parse(Date::excelToDateTimeObject($row['tanggal']));
        $this->removeExistingRecordDate($date, $this->storeId);
        $trx = new IncomeRecord([
            'store_id' => $this->storeId,
            'date' => $date,
            'name' => $row['nama'],
            'amount' => $row['jumlah'],
        ]);
        $trx->user_id = $this->userId;
        return $trx;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    private function removeExistingRecordDate(Carbon $date, int $storeId)
    {
        IncomeRecord::where('store_id', $storeId)
            ->where('date', $date)
            ->delete();
    }
}
