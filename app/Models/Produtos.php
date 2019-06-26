<?php

namespace App\Models;

class Produtos extends RModel
{
    protected $table = "produtos";
    protected $fillable = ["nome", "marca", "preco", "quantidade"];

    protected $rules = [
        'nome' => 'required|min:3',
        'marca' => 'required',
    ];

    protected $messages = [
        'nome.required' => 'Preencha o campo nome',
        'nome.min' => 'Nome deve ter mínimo de 3 caracteres',
        'marca.required' => 'Preencha o campo marca',
    ];

}
