<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model;


class BoardTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['items'];
     /**
     * @param Model $model
     * @return array
     */
     public function transform(Model $model)
     {
        return [
            'uuid'   => (string) $model->uuid,           
            'title'   => $model->title,
        ];
     }


     public function includeItems(Model $model)
    {         
        if(!empty($model->items))
            return $this->collection($model->items, new BoardItemTransformer());
    }

     

    
 
}
