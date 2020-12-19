<?php

namespace App;

use App\Models\Institutions;
use App\Models\Permission;
use App\Observers\InterceptObserversModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cpf',
        'password',
        'birth',
        'gender',
        'avatar',
        'terms',
        'system',
        'institution_id',
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
                    'first_name'               => ['required', 'string', 'max:255'],
                    'last_name'                => ['required', 'string', 'max:255'],
                    'email'                    => ['required', 'string', 'email', 'max:255'],
                    'cpf'                      => ['required', 'string', 'unique:users'],
                    'password'                 => ['required', 'string', 'min:4', 'confirmed'],
                    'password_confirmation'    => ['required', 'string', 'min:4'],
                    'terms'                    => ['required'],
                    'use_api'                  => ['required'],
                    'roles_ids'                => ['required'],
                ],
        ];
    /**
     * End validations =================================================================================================
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRoles($roles)
    {
        if( is_array($roles) || is_object($roles) ) {
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }

    /**
     *
     * Escopes Locais
     *
     */

    /**
     * @return mixed
     */
    public static function scopeUsersInstitution()
    {
        if(isset(auth()->user()->roles->first()->name) && auth()->user()->roles->first()->name=="Administrator")
        {
            return self::where('id', '!=', 1)
                ->where("status", 0)
                ->orWhere("status", 1)->limit(100);
        }
        return self::where('institution_id', auth()->user()->institution->id)
            ->where('id', '!=', 1)
            ->where("status", 0)
            ->where("status", 1);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return Request
     */
    public static function scopeUpdatePassword(User $user, Request $request)
    {
        if($request['password']!=$user->password)
            $request['password'] = Hash::make($request['password']);
            return $request;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function scopeCreateInstitution(array $data)
    {
        $intitution = Institutions::create([
            'name'        => "nd",
            'document'    => $data["cpf"],
            'whatsapp'    => "nd",
            'phone_two'   => "nd",
            'tag'         => "nd",
            'uuid'        => Uuid::uuid4()
        ]);
        return $intitution;
    }

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
        return $this->belongsToMany(\App\Models\Role::class, 'role_user', 'user_id', 'role_id')->withoutGlobalScopes();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institution()
    {
        return $this->hasOne(\App\Models\Institutions::class, 'id', 'institution_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany(\App\Models\AddressUsers::class, "user_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(\App\Models\ContactsUsers::class, "user_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials()
    {
        return $this->hasMany(\App\Models\SocialsUsers::class, "user_id", "id");
    }

    /*
     *
     * Mutators ------------------------
     *
     */

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = str_replace([".", "-", "/"], "", $value);
    }


    // JWT Implements --------------------------------------------------------------------------------------------------

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
