<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactsUsers
 * @package App\Models
 */
class ContactsUsers extends Model
{
    /**
     * @var string
     */
    protected $table = 'contacts_users';

    /**
     * @var array
     */
    protected $fillable = [
        "area_code",
        "number",
        "type",
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
                    "type"                 => ['required'],
                    "user_id"              => ['required']
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                    "main"                 => ['required'],
                    "type"                 => ['required']
                ],

            "saving"                     =>
                [
                    'model'                => ['required'],
                    "main"                 => ['required'],
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
