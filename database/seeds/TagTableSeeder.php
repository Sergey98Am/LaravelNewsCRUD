<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;


class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class,10)->create();
    }
}
