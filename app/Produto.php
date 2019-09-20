<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;


class Produto extends Model
{
    protected $fillable = [
      'nome', 'preco', 'marca', 'quantidade'
    ];

    use DataViewer;

    public static $columns = [
        'id', 'nome', 'marca',
        'created_at', 'updated_at'
    ];
}
