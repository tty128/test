<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    protected $table = 'term_taxonomy';
    protected $primaryKey = 'term_taxonomy_id';
    public $timestamps = false;

    protected $fillable = [
        'term_id',
        'taxonomy',
        'desc',
        'parent',
        'count',
    ];

    public function term()
    {
        return $this->hasOne('App\Term', 'term_id');
    }

    public function termRelationship()
    {
        return $this->belongsToMany('App\Post');
    }
}
