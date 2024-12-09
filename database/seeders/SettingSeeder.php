<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\UnilevelSetting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['slug' => 'currency_locale', 'value' => 'en_US', 'created_at' => '2021-12-02 18:27:19', 'updated_at' => '2021-12-02 18:27:19'],
            ['slug' => 'app_name', 'value' => 'Innovative', 'created_at' => '2021-12-02 18:27:19', 'updated_at' => '2021-12-02 18:27:19'],
            ['slug' => 'access_login', 'value' => 1, 'created_at' => '2022-02-21 18:27:19', 'updated_at' => '2022-02-21 18:27:19'],
            ['slug' => 'commission_sett', 'value' => 1, 'created_at' => '2022-02-21 18:27:19', 'updated_at' => '2022-02-21 18:27:19'],
            ['slug' => 'access_registration', 'value' => 1, 'created_at' => '2022-02-21 18:27:19', 'updated_at' => '2022-02-21 18:27:19'],

        ];

        foreach ($settings as $setting) {
            $find = Setting::where('slug', $setting['slug'])->first();

            if (!$find) {
                Setting::create($setting);
            }
        }

    }
}
