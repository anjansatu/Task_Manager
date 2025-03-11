<?php

namespace App\Imports;

use App\Models\Ssn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SsnImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ssn([
            'first_name' => $row['first_name'] ?? '',
            'last_name'  => $row['last_name'] ?? '',
            'dob'        => $row['dob'] ?? null,
            'address'    => $row['address'] ?? '',
            'city'       => $row['city'] ?? '',
            'state'      => $row['state'] ?? '',
            'zip'        => $row['zip'] ?? '',
            'ssn'        => $row['ssn'] ?? '',
            'year'       => $row['year'] ?? '',
            'country'    => $row['country'] ?? '',
        ]);
    }
}
