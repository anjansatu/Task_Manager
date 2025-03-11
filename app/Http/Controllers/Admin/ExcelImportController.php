<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ssn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function importExcel(Request $request)
{
    ini_set('memory_limit', '-1');

    $validator = Validator::make($request->all(), [
        'xlsxFile' => 'required|mimes:xlsx',
    ]);

    if ($validator->fails()) {
        $notification = [
            'messege' => __('Please upload xlsx file !!'),
            'alert-type' => 'error'
        ];
        return redirect()->route('your_model.index')->with($notification);
    }

    $file = $request->file('xlsxFile');
    $filePath = $file->storeAs('uploads', $file->getClientOriginalName());
    $xldata = Excel::toArray([], storage_path("app/$filePath"));

    foreach ($xldata[0] as $key => $row) {
        if ($key == 0) continue;

        Ssn::updateOrCreate(
            ['ssn' => $row[7]], // Assuming SSN is unique
            [
                "first_name" => $row[0],
                "last_name" => $row[1],
                "dob" => $row[2],
                "address" => $row[3],
                "city" => $row[4],
                "state" => $row[5],
                "zip" => $row[6],
                "ssn" => $row[7],
                "year" => $row[8],
                "country" => $row[9],
            ]
        );
    }

    $notification = [
        'messege' => __("A new record has been created or updated"),
        'alert-type' => 'success'
    ];

    return redirect()->route('admin.ssns.index')->with($notification);
}

}
