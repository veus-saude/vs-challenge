<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleUser
 * @package App\Models
 */
class RoleUser extends Model
{
    /**
     * @var string
     */
    protected $table = 'role_user';

    /**
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id'
    ];

    /*
     *
     * Relations ------------
     *
     */
}
