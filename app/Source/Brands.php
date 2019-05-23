<?php

namespace App\Source;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Brands
 * @method self find()
 * @property int id
 * @property string name
 * @package App\Source
 */
class Brands extends Model
{
    protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}