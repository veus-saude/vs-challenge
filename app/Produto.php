<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {

  protected $table = 'produtos';

  protected $fillable = [
    'nome'
  ];

  protected $hidden = [
    'created_at','updated_at'
  ];

  public function estoque() {
    return $this->belongsToMany('App\estoque');
  }

}
