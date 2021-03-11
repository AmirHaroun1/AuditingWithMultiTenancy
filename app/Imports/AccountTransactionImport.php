<?php

namespace App\Imports;

use App\account_transaction;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountTransactionImport implements ToArray,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function array(array  $row)
    {

    }
    public function chunkSize(): int
    {
        return 300;
    }
    public function batchSize(): int
    {
        return 100;
    }
}
