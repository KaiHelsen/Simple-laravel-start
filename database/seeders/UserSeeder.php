<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = str::random(10);
        \DB::table('users')->insert([
            'name' => $name,
            'email' => $name . '@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
