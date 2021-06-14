<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    protected $table = 'term_taxonomy';
    protected $primaryKey = 'term_taxonomy_id';
    public $timestamps = false;

    protected $fillable = [
        'taxonomy',
        'desc',
        'parent',
        'count',
    ];

    public function term()
    {
        return $this->belongsTo('App\Term');
    }

    public function termRelationship()
    {
        return $this->belongsToMany('App\Post');
    }
}
