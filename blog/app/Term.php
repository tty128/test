<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'term';
    protected $primarykey = 'term_id';

    public function termTaxonomy()
    {
        return $this->belongsTo('App\TermTaxonomy', 'term_id');
    }
}
