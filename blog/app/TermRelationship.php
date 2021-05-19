<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    protected $table = 'term_relationship';
    protected $primarykey = ['post_id', 'term_taxonomy_id'];

    public $incrementing = false;

    protected $fillable = ['post_id', 'term_taxonomy_id'];
}
