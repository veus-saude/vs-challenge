<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model {

  protected $table = 'fornecedor';

  protected $fillable = [
    'nome'
  ];

  protected $hidden = [
    'created_at','updated_at'
  ];

}
