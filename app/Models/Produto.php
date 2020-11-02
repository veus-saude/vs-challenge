<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    public $filters = [];
    public $sortBy;
    public $perPage;

    protected $fillable =[
        'nome',
        'marca_id',
        'preco',
        'quantidade'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function getProdutos()
    {
        $query = $this::query();

        if ($this->nome) {
            $query->where('nome', 'like', '%' . $this->nome . '%');
        }
        if ($this->filters) {
            $explode = explode(':', $this->filters);
          
            $valor = $explode[1];
            $marca = DB::table('marcas')->where('nome', $valor)->first();

            $query->where('marca_id', '=', $marca->id);
        }

        if ($this->sortBy) {
            $query->orderBy($this->sortBy, 'ASC');
        }

        return $query->paginate($this->perPage ?? 10);
    }

}
