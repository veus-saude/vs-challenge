<?php
namespace Model\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * Primary key name
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * Check if this table will use timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = ['product_id'];

}
