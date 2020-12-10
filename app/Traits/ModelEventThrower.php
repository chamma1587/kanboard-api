<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

/**
 * Class ModelEventThrower
 * @package App\Traits
 *
 *  Automatically throw Add, Update, Delete events of Model.
 */
trait ModelEventThrower {

    protected static function boot() {
        parent::boot();

        static::saving(function($model){
            $uuid =  UuidManager::generateUuid();  
            if($model->uuid == null){
                $model->uuid = $uuid->string;
            }                  
        });
       
    }

}