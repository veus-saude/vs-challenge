<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeUsers extends Model {

    protected $table = 'type_users';

    protected $fillable = [
        'type_id','user_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];
}
