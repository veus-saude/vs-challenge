<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRole
 * @package App\Models
 */
class PermissionRole extends Model
{
    /**
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * @var array
     */
    protected $fillable = [
        'permission_id',
        'role_id',
        'system',
    ];

    /*
     *
     * Relations ------------
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permission()
    {
        return $this->hasOne(\App\Models\Permission::class, "id", "permission_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(\App\Models\Role::class, "id", "role_id");
    }
}
