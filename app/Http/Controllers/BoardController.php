<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth;
use App\User;
use Validator;
use App\Traits\UuidManager;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Repository\Contracts\BoardRepositoryInterface;
use Dingo\Api\Exception\ValidationHttpException;
use App\Transformers\BoardTransformer;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql;

class BoardController extends Controller
{
    use UuidManager;
    use Helpers;    

   
    protected $boardRepository; 
    
    /**
     * BoardRepository constructor.
     * @param BoardRepositoryInterface $BoardRepository
     */

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
       $this->boardRepository = $boardRepository;
    }

     /**
     * Get All boards
     * @return JsonResponse
     */
    
    public function getBoards()
    {    
       $boards = $this->boardRepository->getAllBoards();

       if(count($boards) > 0)
            return $this->collection($boards, new BoardTransformer);        
        
       return  $this->response->error('Boards not found', 404);  
    }

    /**
     * Add New Board
     * @param Request $request
     * @return JsonResponse
     */
    public function addBoard(Request $request)
    {    
        $payload =  $request->all();   

        $validationFields = [           
            'title' => 'required',             
        ];   

        $validator = Validator::make($payload, $validationFields);
        
        if($validator->fails())
          throw new ValidationHttpException($validator->errors());

       $board = $this->boardRepository->addBoard($payload);

       if($board)
            return  $this->responseSuccess(null, null);   
        
       return  $this->response->error('Board not create', 500);  
    }


     /**
     * Update Board item
     * @param Request $request
     * @return JsonResponse
    */
    public function updateBoardData(Request $request)
    {    
       $payload =  $request->all();      
       $board = $this->boardRepository->updateBoardData($payload);

       if(!$board)
         return  $this->response->error('Boards not updated', 500); 
         
        return  $this->responseSuccess(null, null);   
    }

     /**
     * Add New Board item
     * @param Request $request
     * @return JsonResponse
    */
    public function addBoardItem(Request $request, $uuid)
    {    
        $payload =  $request->all();   

        $validationFields = [           
            'title' => 'required',             
            'description' => 'required',             
        ];   

        $validator = Validator::make($payload, $validationFields);
        
        if($validator->fails())
          throw new ValidationHttpException($validator->errors());

        $board =  $this->boardRepository->getByUuid('Board', $uuid);

        if(!$board)
            return  $this->response->error('Board not found', 404);   

        $payload['board_id'] = $board->id;
        $board = $this->boardRepository->addBoardItem($payload);

        if($board)
            return  $this->responseSuccess(null, null);   
            
        return  $this->response->error('Board not create', 500);  
    }


     /**
     * Update Board item
     * @param Request $request
     * @return JsonResponse
    */
    public function updateBoardItem(Request $request, $uuid)
    {    
        $payload =  $request->all();   

        $validationFields = [           
            'title' => 'required',             
            'description' => 'required',             
        ];   

        $validator = Validator::make($payload, $validationFields);
        
        if($validator->fails())
          throw new ValidationHttpException($validator->errors());

        $boardItem =  $this->boardRepository->getByUuid('BoardItem', $uuid);

        if(!$boardItem)
            return  $this->response->error('Board item not found', 404);   

        $board = $this->boardRepository->updateBoardItem($payload, $boardItem->id);

        if($board)
            return  $this->responseSuccess(null, null);       
            
       return  $this->response->error('Board item not updated', 500);  
    }

     /**
     * Delete Board
     * @param String $uuid
     * @return JsonResponse
    */
    public function deleteBoard($uuid)
    {    
        $board =  $this->boardRepository->getByUuid('Board', $uuid);

        if(!$board)
            return  $this->response->error('Board not found', 404);   

        $this->boardRepository->deleteBoard($board->id);
        return  $this->responseSuccess(null, null);   
    }


     /**
     * Delete Board item
     * @param String $uuid
     * @return JsonResponse
    */
    public function deleteBoardItem($uuid)
    {    
        $boardItem =  $this->boardRepository->getByUuid('BoardItem', $uuid);

        if(!$boardItem)
            return  $this->response->error('Board item not found', 404); 
            
        $this->boardRepository->deleteBoardItem($boardItem->id);

       return  $this->responseSuccess(null, null);  
    }


     /**
     * Download db dump
     * @return JsonResponse
    */
    public function downloadDbDump()
    {
        $databaseName  = config('database.connections.mysql.database');
        $userName      = config('database.connections.mysql.username');
        $password      = config('database.connections.mysql.password');

        MySql::create()
        ->setDbName($databaseName)
        ->setUserName($userName)
        ->setPassword($password)
        ->dumpToFile('kanboard.sql');
    }
    

    
}
