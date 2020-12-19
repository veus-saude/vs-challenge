<?php


namespace App\Helpers\Models;


class SyncRelations
{
    /**
     * @param $model
     * @param $relation
     * @param $ids
     */
    public static function init($model, $relation, $ids)
    {
        if(isset($model) && isset($model->$relation) && isset($ids))
        {
            $model->$relation()->sync($ids, true);
            $model->save();
        }
    }
}
