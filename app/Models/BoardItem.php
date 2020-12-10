<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelEventThrower;

class BoardItem extends Model
{
    use ModelEventThrower;
    
    protected $fillable = [
        'uuid','board_id', 'title', 'description', 'created_at', 'updated_at'
    ];
}
