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
            'nama' => 'Acid',
            'email' => 'acid@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'nama' => 'Jul',
            'email' => 'jul@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'nama' => 'Ryoukaii',
            'email' => 'budiimamprsty@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'superadmin'
        ]);
        User::create([
            'nama' => 'Rey',
            'email' => 'rey@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'nama' => 'Dab',
            'email' => 'dav@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'nama' => 'Gultom',
            'email' => 'gultom@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pegawai'
        ]);
        User::create([
            'nama' => 'P',
            'email' => 'p@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'FO'
        ]);
    }
}