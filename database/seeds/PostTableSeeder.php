<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class,15)->create();
    }
}
