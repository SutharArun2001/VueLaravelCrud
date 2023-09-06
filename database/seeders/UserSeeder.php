<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => Str::random(1).'user',
            'last_name' => Str::random(1).'user',
            'user_name' => Str::random(1).'user',
            'email' => Str::random(2) . 'user@gmail.com',
            'phone_number' => 8855223366,
            'gender' => 'male',
            'password' => Hash::make('aa'),
        ]);
    }
}
