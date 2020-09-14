<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Country::class,19)->create();

        $countries = [
            [
                'name' => 'Armenia',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        Country::insert($countries);
    }
}
