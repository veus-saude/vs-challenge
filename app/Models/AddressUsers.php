<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressUsers
 * @package App\Models
 */
class AddressUsers extends Model
{
    /**
     * @var string
     */
    protected $table = 'address_users';

    /**
     * @var array
     */
    protected $fillable = [
        "cep",
        "street",
        "district",
        "city",
        "state",
        "number",
        "complement",
        "main",
        "user_id"
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
                    "main"                 => ['required'],
                    "user_id"              => ['required']
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                    "main"                 => ['required']
                ],

            "saving"                     =>
                [
                    'model'                => ['required'],
                    "main"                 => ['required']
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
