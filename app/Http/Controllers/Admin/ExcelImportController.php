<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ssn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelImportController extends Controller
{
    public function importExcel(Request $request)
    {
        ini_set('memory_limit', '-1');  // Increase memory limit for large files

        // Validate that the uploaded file is an xlsx file
        $validator = Validator::make($request->all(), [
            'xlsxFile' => 'required|mimes:xlsx',  // Only xlsx files are allowed
        ]);

        // If validation fails, redirect with an error message
        if ($validator->fails()) {
            $notification = [
                'messege' => __('Please upload an xlsx file!!'),
                'alert-type' => 'error'
            ];
            return redirect()->route('admin.ssns.index')->with($notification);
        }

        // Get the uploaded file and store it
        $file = $request->file('xlsxFile');
        $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

        // Convert the Excel data to an array
        $xldata = Excel::toArray([], storage_path("app/$filePath"));

        // Loop through each row in the Excel sheet
        foreach ($xldata[0] as $key => $row) {
            // Skip the header row (usually the first row)
            if ($key == 0) continue;

            // Ensure the 'dob' column is parsed correctly
            // Convert Excel date serial number to DateTime object and format it as 'Y-m-d'
            $dateTime = Date::excelToDateTimeObject($row[7]); // Assumed dob is at column index 7

            // Ensure that the date is valid
            if ($dateTime && Carbon::parse($dateTime)->isValid()) {
                $dob = Carbon::parse($dateTime)->format('Y-m-d');
            } else {
                // If the date is invalid, set it to null
                $dob = null;
            }

            // Trim any extra spaces from the dob
            $dob = trim($dob);

            // Insert or update the SSN record
            Ssn::updateOrCreate(
                ['ssn' => $row[6]], // Assuming SSN is unique and present in column 6
                [
                    "first_name" => $row[0], // Column 0: first_name
                    "last_name" => $row[1],  // Column 1: last_name
                    "address" => $row[2],    // Column 2: address
                    "city" => $row[3],       // Column 3: city
                    "state" => $row[4],      // Column 4: state
                    "zip" => $row[5],        // Column 5: zip
                    "ssn" => $row[6],        // Column 6: ssn
                    "dob" => $dob,           // Column 7: dob (date of birth)
                    "year" => $row[8],       // Column 8: year
                    "country" => $row[9],    // Column 9: country
                ]
            );
        }

        // Set a success notification message
        $notification = [
            'messege' => __("A new record has been created or updated"),
            'alert-type' => 'success'
        ];

        // Redirect back with success notification
        return redirect()->route('admin.ssns.index')->with($notification);
    }
}
