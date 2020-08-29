<?php

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
        $users = [
            [
                'name' => 'Sergey Gabrielyan',
                'email' => 'serg98barca@gmail.com',
                'password' => Hash::make('serg_password'),
            ],
            [
                'name' => 'Naira Hovsepyan',
                'email' => 'nhovsepyan@gmail.com',
                'password' => Hash::make('naira_password'),
            ],
            [
                'name' => 'Razmik Khachikyan',
                'email' => 'khachikyan.1998@inbox.ru',
                'password' => Hash::make('razmik_password'),
            ]
        ];

        User::insert($users);
    }
}
