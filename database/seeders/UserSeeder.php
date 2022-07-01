<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name'      => 'admin',
                'alamat'    => null,
                'nohp'      => null,
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'admin'
            ],

            [
                'name'      => 'customer',
                'alamat'    => 'Malang',
                'nohp'      => '08123456789',
                'email'     => 'customer@gmail.com',
                'password'  => Hash::make('123456789'),
                'role'     => 'customer'
            ]
        ]);
    }
}
