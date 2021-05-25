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
                'term_id' => 0,
                'taxonomy' => 'tag1',
                'desc' => 'taggable1',
                'parent' => 0,
                'count' => 1,
            ]
        );

        App\TermTaxonomy::create(
            [
                'term_id' => 1,
                'taxonomy' => 'cate1',
                'desc' => 'category1',
                'parent' => 0,
                'count' => 1,
            ]
        );
    }
}
