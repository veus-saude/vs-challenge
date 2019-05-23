<?php

namespace App\Source;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Produtcs
 * @method self find()
 * @property int id
 * @property int id_type
 * @property int id_brand
 * @property string name
 * @package App\Source
 */
class Produtcs extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_brand',
        'id_type',
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
     * @return int
     */
    public function getIdType()
    {
        return $this->id_type;
    }

    /**
     * @param int $id_type
     */
    public function setIdType($id_type)
    {
        $this->id_type = $id_type;
    }

    /**
     * @return int
     */
    public function getIdBrand()
    {
        return $this->id_brand;
    }

    /**
     * @param int $id_brand
     */
    public function setIdBrand($id_brand)
    {
        $this->id_brand = $id_brand;
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