<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{  

    protected $fillable = [
         'type', 'old_data', 'new_data', 'created_at', 'updated_at'
    ];
}
