<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    //
    protected $table = "produtos";
    protected $fillable = [
        "nome",
        "marca",
        "quantidade",
        "preco",
        "quantidade_estoque"
    ];

}
