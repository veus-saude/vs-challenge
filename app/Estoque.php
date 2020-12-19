<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model {

  protected $table = 'estoque';

  protected $fillable = [
    'id_produto', 'id_fornecedor', 'lote', 'fabricacao', 'validade', 'quantidade', 'valor'
  ];

  protected $hidden = [
    'created_at','updated_at'
  ];

  public function fornecedor() {
    return $this->belongsToMany('App\fornecedor');
  }

  public function produto() {
    return $this->belongsToMany('App\produto');
  }
}
