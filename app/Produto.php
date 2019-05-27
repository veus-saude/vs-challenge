<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $guarded = [];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
