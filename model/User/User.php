<?php
namespace Model\User;

use Illuminate\Auth\Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Primary key name
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Check if this table will use timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = ['id_usuario'];

}
