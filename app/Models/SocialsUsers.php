<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialsUsers
 * @package App\Models
 */
class SocialsUsers extends Model
{
    /**
     * @var string
     */
    protected $table = 'socials_users';

    /**
     * @var array
     */
    protected $fillable = [
        "username",
        "label",
        "type",
        "user_id",
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
                    "username"             => ['required'],
                    "label"                => ['required'],
                    "type"                 => ['required'],
                    "user_id"              => ['required']
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                    "username"             => ['required'],
                    "label"                => ['required'],
                    "type"                 => ['required']
                ],

            "saving"                     =>
                [
                    'model'                => ['required'],
                    "username"             => ['required'],
                    "label"                => ['required'],
                    "type"                 => ['required']
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

}
