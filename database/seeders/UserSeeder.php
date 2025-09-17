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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'contact' => '081234567890',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'), // bcrypt otomatis
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         DB::table('users')->insert([
            'name' => 'Pegawai',
            'email' => 'pegawai@gmail.com',
            'contact' => '081234567891',
            'role' => 'pegawai',
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'), // bcrypt otomatis
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
