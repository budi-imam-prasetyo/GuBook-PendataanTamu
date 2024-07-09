<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Acid',
            'email' => 'acid@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'name' => 'Jul',
            'email' => 'jul@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'name' => 'Ryoukaii',
            'email' => 'budiimamprsty@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Rey',
            'email' => 'rey@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'name' => 'Dab',
            'email' => 'dav@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'name' => 'Gultom',
            'email' => 'gultom@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
    }
}