<?php

namespace App\Source;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Types
 * @method self find()
 * @property int id
 * @property string name
 * @package App\Source
 */
class Types extends Model
{
    protected $table = 'types';

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