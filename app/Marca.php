<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $guarded = [];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
