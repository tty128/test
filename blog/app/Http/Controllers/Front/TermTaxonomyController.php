<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Post;
use App\Taxonomy;
use App\Term;
use Illuminate\Http\Request;

class TermTaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Term $term)
    {
        return $term
            ->join('taxonomy as tx', 'taxonomy_id', '=', 'tx.id')
            ->get([
                'term.id',
                'term.name',
                'tx.name as taxonomy_name'
            ])
            ->groupBy('taxonomy_name');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Term $term, $taxonomy, $name)
    {
        if ($taxonomy == 'category') {
            return $post
                ->where('status', '=', 'public')
                ->where('category', '=', $name)
                ->orderBy('created_at', 'desc')
                ->get([
                    'id',
                    'title',
                    'category'
                ]);
        } else {
            return $term->find($term->where('taxonomy_id','=', Taxonomy::where('name', '=', $taxonomy)->min('id'))
                ->min('id'))->posts()
                ->where('status', '=', 'public')
                ->orderBy('created_at','desc')
                ->get([
                    'post.id',
                    'title',
                    'category'
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
