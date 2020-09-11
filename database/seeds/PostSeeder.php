<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 3)->create([
            'user_id' => 3,
            'hashtag_id' => 2,
        ]);
    }
}
