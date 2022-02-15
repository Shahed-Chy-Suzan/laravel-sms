<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
             'name' => 'user',
             'email' => 'user@gmail.com',
             'phone' => '01700000000',
             'password' => Hash::make('user'),
            ],

            [
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'phone' => '01800000000',
             'password' => Hash::make('admin'),
            ]
         ]);
    }
}
