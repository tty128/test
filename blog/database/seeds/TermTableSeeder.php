<?php

use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Term::create(
            [
                'taxonomy_id'=>2,
                'name' => 'hand',
            ]
        );
        App\Term::create(
            [
                'taxonomy_id' => 1,
                'name' => 'body',
            ]
        );
    }
}
