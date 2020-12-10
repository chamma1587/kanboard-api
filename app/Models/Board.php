<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelEventThrower;

class Board extends Model
{
    use ModelEventThrower;
    
    protected $fillable = [
        'uuid', 'title', 'created_at', 'updated_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\BoardItem');
    }    
}
