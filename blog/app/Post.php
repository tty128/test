<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'post_id';

    protected $hidden = [
        'post_pass'
    ];

    protected $guard = [
        'post_pass'
    ];

    public function postmeta()
    {
        return $this->hasOne('App\PostMeta','post_id');
    }

    public function termRelationship()
    {
        return $this->belongsToMany('App\TermTaxonomy','term_relationship','post_id','term_taxonomy_id');
    }
}
