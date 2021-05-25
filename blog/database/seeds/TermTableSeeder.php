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
                'term_name' => 'tag',
                'term_group' => 0,
            ]
        );
        App\Term::create(
            [
                'term_name' => 'category',
                'term_group' => 1,
            ]
        );
    }
}
