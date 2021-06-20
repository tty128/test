<?php

use Illuminate\Database\Seeder;

class TermTaxonomyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TermTaxonomy::create(
            [
                'taxonomy' => 'TAG',
                'desc' => 'taggable',
                'parent' => 0,
            ]
        );

        App\TermTaxonomy::create(
            [
                'taxonomy' => 'CATEGORY',
                'desc' => 'category',
                'parent' => 0,
            ]
        );
    }
}
