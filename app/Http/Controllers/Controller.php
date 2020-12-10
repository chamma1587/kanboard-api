<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * Success reponse
     *
     * @param mixed $model
     * @param Transformer $transfomer
     * @param string $message
     * @param $string $code
     * 
     * @return  $mixed
     */
    public function responseSuccess($model, $transfomer, $message = 'Success', $code = 200)
    {
        $meta = [
            'message'=> $message,
            'status_code' => $code,
        ];
        if(!$model)
            return $this->response->array($meta);

        return $this->response->item($model, $transfomer)->setMeta($meta);
    }
   

    /**
     * Upload new file and store it
     * @param  Request $request Request with form data: filename and file info
     * @return boolean          True if success, otherwise - false
     */

    public function uploadImage($file, $module, $fileName){

        Storage::putFileAs('/public/' . $module .  '/', $file, $fileName);
           
    }
    
}
