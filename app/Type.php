<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

  protected $table = 'type';

  protected $fillable = [
      'type'
  ];

  protected $hidden = [
      'created_at','updated_at'
  ];
}
