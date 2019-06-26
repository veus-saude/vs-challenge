<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
abstract class RModel extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [];
    protected $rules = [];
    protected $errors;
    protected $messages = [];

    public function validate()
    {
        $v = Validator::make($this->attributes, $this->rules, $this->messages);
        if ($v->fails())
        {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function beforeSave() {

        return true;
    }

    public function save(array $options = []) {
        try {
            if (!$this->beforeSave()) {
                return false;
            }

            return parent::save($options);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }   
    }

}
