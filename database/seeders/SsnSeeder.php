<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SsnImport;

class SsnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = public_path('excel/ssn.xlsx'); 

        if (!file_exists($path)) {
            dd('File not found!');
        }

        Excel::import(new SsnImport, $path);

        echo "Data imported successfully!";
    }
}
