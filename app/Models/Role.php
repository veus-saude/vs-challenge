<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 */
class Role extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'system',
        'group'
    ];

    /**
     * Start validations ===============================================================================================
     */
    /**
     * Start Observers
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new InterceptObserversModel);
    }

    /**
     * The attributes in validations.
     *
     * @var array
     */
    public static $rules =
        [
            "creating"                     =>
                [
                    'model'                => ['required'],
                    'name'                 => ['required', 'string', 'max:255'],
                    'label'                => ['required', 'string', 'max:255'],
                    'group'                => ['required', 'string', 'max:255'],
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                    'name'                 => ['required', 'string', 'max:255'],
                    'label'                => ['required', 'string', 'max:255'],
                    'group'                => ['required', 'string', 'max:255'],
                ],

            "saving"                     =>
                [
                    'model'                => ['required'],
                    'name'                 => ['required', 'string', 'max:255'],
                    'label'                => ['required', 'string', 'max:255'],
                    'group'                => ['required', 'string', 'max:255'],
                ],
        ];
    /**
     * End validations =================================================================================================
     */
    /**

    /*
     *
     * Relations ------------
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'permission_role', 'role_id', 'permission_id')->withoutGlobalScopes();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'role_user', 'role_id', 'user_id')->withoutGlobalScopes();
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
