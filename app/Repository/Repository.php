<?php
namespace App\Repository;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\ActionLog;
use App\Models\Classroom;
use App\Traits\UuidManager;
use App\Traits\Config;


class Repository
{

    public function ActionLog($data)
    {      
        return ActionLog::create($data);
    }   
}