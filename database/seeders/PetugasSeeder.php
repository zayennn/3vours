<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'petugas@3vours.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);
    }
}
