<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class,15)->create();
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
        ];

        User::insert($users);
    }
}
