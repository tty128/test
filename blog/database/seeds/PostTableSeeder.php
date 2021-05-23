<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            App\Post::create([
            'post_author' => 0,
            'post_title' => 'title'.$i,
            'post_content' => 'sampletext'.$i,
            'post_status' => 'public',
            'post_password' => 'password',
            'post_name' => '/'.$i,
            'post_parent' => $i,]
            );
        }
    }
}
