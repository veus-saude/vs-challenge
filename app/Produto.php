<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $table = 'produtos'; // nome da tabela
    protected $primaryKey = 'id'; // chave primária
    public $incrementing = true; // indica se os IDs são auto-incremento
    public $timestamps = true; // ativa os campos created_at e updated_a

    /* fillable possibilitará criar novos registros simplesmente usando
     * o método create e outros da classe Model passando
     * um array associativo as colunas da classe
     */
    protected $fillable = [
        'id',
        'nome', 
        'marca',
        'preco',
        'quantidade',
        'status'
    ];
    
}
