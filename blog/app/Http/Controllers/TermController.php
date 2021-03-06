<?php

namespace App\Http\Controllers;

use App\Term;
use App\Taxonomy;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Http\Request;

class TermController extends Controller
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
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Term $term,TermTaxonomy $term_taxonomy)
    {
        Term::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        return $term;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $term->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $term->delete();
    }
}
