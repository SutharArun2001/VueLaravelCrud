<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use IntlChar;
use Ramsey\Uuid\Type\Integer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => Str::random(5),
            'last_name' => Str::random(5),
            'user_name' => Str::random(5),
            'email' => Str::random(3).'@gmail.com',
            'phone_number' => 8855223366,
            'gender' => 'male',
            'password' => 'admin',
            'email' => Str::random(5).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

    }
