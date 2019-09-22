<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataViewer;


class Produto extends Model
{
    protected $fillable = [
      'nome', 'preco', 'marca', 'quantidade'
    ];

}
