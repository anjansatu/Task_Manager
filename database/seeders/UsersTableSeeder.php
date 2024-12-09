<?php

namespace Database\Seeders;

use App\Models\Deposit;
use App\Models\Unilevel;
use App\Models\UnilevelChild;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Devtest',
            'email' => 'devtest@yopmail.com',
            'password' => bcrypt('123456'),
            'username' => 'devtest',
            'email_verified' => 1,
            'email_verified_at' => now(),
            'phone_number' => '0123456789',
            'status' => 1,
        ]);
    }
}
