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
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'nama'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'role'              => 'admin',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin123'),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Member user
        DB::table('users')->insert([
            'nama'              => 'Member',
            'email'             => 'member@gmail.com',
            'role'              => 'member',
            'email_verified_at' => now(),
            'password'          => Hash::make('member123'),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
