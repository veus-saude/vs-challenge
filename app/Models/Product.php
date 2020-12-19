<?php

namespace App\Models;

use App\Observers\InterceptObserversModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 */
class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'brand',
        'price',
        'stock'
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
                    'brand'                => ['required', 'string', 'max:255'],
                    'price'                => ['required', 'string', 'max:255'],
                    'stock'                => ['required', 'string', 'max:255'],
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                    'name'                 => ['required', 'string', 'max:255'],
                    'brand'                => ['required', 'string', 'max:255'],
                    'price'                => ['required', 'string', 'max:255'],
                    'stock'                => ['required', 'string', 'max:255'],
                ],

            "saving"                     =>
                [
                    'model'                => ['required'],
                    'name'                 => ['required', 'string', 'max:255'],
                    'brand'                => ['required', 'string', 'max:255'],
                    'price'                => ['required', 'string', 'max:255'],
                    'stock'                => ['required', 'string', 'max:255'],
                ],
        ];
    /**
     * End validations =================================================================================================
     */

}
