<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use SoftDeletes;

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

    public function postmeta()
    {
        return $this->hasOne('App\PostMeta','post_id');
    }

    public function termRelationship()
    {
        return $this->belongsToMany('App\TermTaxonomy','term_relationship','post_id','term_taxonomy_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($q) {
            if(Auth::check()){
                $user_id = Auth::id();
                $q->post_author = $user_id;
            }
        });
        self::updating(function ($q) {
            if (Auth::check()) {
                $user_id = Auth::id();
                $q->post_update_author = $user_id;
            }
        });
    }
}
