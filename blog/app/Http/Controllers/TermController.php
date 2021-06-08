<?php

namespace App\Http\Controllers;

use App\Term;
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
        $term = $term->from('term_taxonomy as ttx')
            ->join('term as t','ttx.term_id','=','t.term_id')
            ->get([
                'term_taxonomy_id',
                'taxonomy as taxonomy_name',
                't.term_name as term_name',
                'desc',
                'ttx.created_at',
                'ttx.updated_at',
            ]);
        return $term;
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
    public function store(Request $request)
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
