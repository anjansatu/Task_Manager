<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        \DB::table('admins')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Mr. Admin',
                    'username' => 'admin',
                    'email' => 'admin@email.com',
                    'email_verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'password' => bcrypt("123456"),
                    'status' => 1,
                    'is_admin' => EXISTING_ADMIN,
                    'created_at' => Carbon::now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'No Reply',
                    'username' => 'no-reply',
                    'email' => 'admin2@email.com',
                    'email_verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'password' => bcrypt("123456"),
                    'status' => 1,
                    'is_admin' => EXISTING_ADMIN,
                    'created_at' => Carbon::now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'New Admin',
                    'username' => 'new-admin',
                    'email' => 'newadmin@email.com',
                    'email_verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'password' => bcrypt("123456"),
                    'status' => 1,
                    'is_admin' => NEW_ADMIN,
                    'created_at' => Carbon::now(),
                )
        ));
    }

}
