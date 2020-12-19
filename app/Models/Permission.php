<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'group',
        'system',
        'default',
        'auth'
    ];

    /*
     *
     * Relations ------------
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'permission_role', 'permission_id', 'role_id')->withoutGlobalScopes();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pivotPermission()
    {
        return $this->hasMany(\App\Models\Permission::class, "permission_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pivotRole()
    {
        return $this->hasMany(\App\Models\Role::class, "role_id", "id");
    }

}
