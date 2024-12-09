<?php

use App\Models\Setting;


function isAdmin()
{
    $admin = auth('admin')->user()->is_admin;

    if ($admin == EXISTING_ADMIN) {
        return true;
    }else{
        return false;
    }

}


function allsetting($array = null)
{
    if (!isset($array[0])) {
        $allsettings = Setting::get();
        if ($allsettings) {
            $output = [];
            foreach ($allsettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } elseif (is_array($array)) {
        $allsettings = Setting::whereIn('slug', $array)->get();
        if ($allsettings) {
            $output = [];
            foreach ($allsettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } else {
        $allsettings = Setting::where(['slug' => $array])->first();
        if ($allsettings) {
            $output = $allsettings->value;
            return $output;
        }
        return false;
    }
}


function randomNumber($a = 10)
{
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';

    $c_letters = strlen($letters) - 1;
    $c_numbers = strlen($numbers) - 1;

    $z = '';

    // Generate first 3 characters from letters
    for ($i = 0; $i < 3; $i++) {
        $y = rand(0, $c_letters);
        $z .= substr($letters, $y, 1);
    }

    // Generate remaining characters from numbers
    for ($i = 3; $i < $a; $i++) {
        $y = rand(0, $c_numbers);
        $z .= substr($numbers, $y, 1);
    }

    return $z;
}
