<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
