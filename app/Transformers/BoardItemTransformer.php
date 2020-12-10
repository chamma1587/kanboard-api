<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model;


class BoardItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];
     /**
     * @param Model $model
     * @return array
     */
     public function transform(Model $model)
     {
        return [
            'uuid'   => (string) $model->uuid,           
            'title'   => $model->title,
            'description'   => $model->description,
        ];
     }

     

    
 
}
