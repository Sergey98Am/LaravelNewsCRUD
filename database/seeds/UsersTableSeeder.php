<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,9)->create();

        $users = [
            [
                'first_name' => 'Sergey',
                'last_name' => 'Gabrielyan',
                'email' => 'serg98barca@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'date_of_birth' => Carbon::parse('1998-01-10')->format('y-m-d'),
                'gender' => 'Male',
                'password' => Hash::make('serg_password'),
                'country_id' => 20,
                'role_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        User::insert($users);
    }
}
