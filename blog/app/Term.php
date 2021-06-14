<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'term';
    protected $primaryKey = 'term_id';
    public $timestamps = false;

    protected $fillable = [
        'term_name',
        'term_taxonomy_id',
        'term_group',
    ];

    public function termTaxonomy()
    {
        return $this->hasMany('App\TermTaxonomy', 'term_id');
    }
}
