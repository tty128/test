<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'post_id';

    protected $hidden = [
        'post_password'
    ];

    protected $fillable = [
        'post_author',
        'post_title',
        'post_content',
    ];

    public function setPostAuthorAttribute()
    {
        $this->attributes['post_author'] = 1;
    }

    public function postmeta()
    {
        return $this->hasOne('App\PostMeta','post_id');
    }

    public function termRelationship()
    {
        return $this->belongsToMany('App\TermTaxonomy','term_relationship','post_id','term_taxonomy_id');
    }
}
