<?php
namespace App\Repository;

use DB;
use App\Models\Board;
use App\Models\BoardItem;
use App\Traits\UuidManager;
use App\Repository\Contracts\BoardRepositoryInterface;

class BoardRepository extends Repository implements BoardRepositoryInterface
{
    use UuidManager;

    public function getByUuid($model, $uuid)
    {
        $modelName = 'App\\Models\\'.$model;
        return  $modelName::where('uuid', $uuid)->first();
    }


    public function getAllBoards()
    {
        return Board::select('id', 'uuid', 'title')->get();
    }


    public function updateBoardData($payload)
    {
        DB::beginTransaction();
        
        try {
            $oldData = Board::with('items')->get();
            foreach ($payload as $key => $item) {
                
                $board = Board::where('uuid', $item['uuid'])->first();              
                $board->items()->delete();      
                if (count($item['items']['data']) > 0 && $board) {      
                    $data =[];             
                    foreach ($item['items']['data'] as $itemData) {
                        $uuid = UuidManager::generateUuid();
                        $boardItem = new BoardItem();
                        $boardItem->uuid = $uuid->string;
                        $boardItem->title = $itemData['title'];
                        $boardItem->description = $itemData['description'];
                        $data[] = $boardItem;
                    }           
                    
                    $board->items()->saveMany($data);
                    
                }
            }

            $data = [
                'type' => 'Board position changed',
                'new_data' => json_encode($payload),
                'old_data' => json_encode($oldData)
             ];

            $this->ActionLog($data);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);           
            return false;
        }
    }

    public function addBoard($payload)
    {
        DB::beginTransaction();
        
        try {
            $board = Board::create($payload);
            if ($board) {
                $data = [
                'type' => 'Add new board',
                'new_data' => $board
            ];
                $this->ActionLog($data);
            }
            DB::commit();
            return $board;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return false;
        }
    }


    public function addBoardItem($payload)
    {
        DB::beginTransaction();
        
        try {
            $boardItem = BoardItem::create($payload);
            if ($boardItem) {
                $data = [
                'type' => 'Add new Item',
                'new_data' => $boardItem
            ];
                $this->ActionLog($data);
            }
            DB::commit();
            return $boardItem;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return false;
        }
    }

    public function updateBoardItem($payload, $id)
    {
        DB::beginTransaction();
        try {
            $boardItem =   BoardItem::where('id', $id)->first();

            if ($boardItem) {
                $boardItem->update($payload);

                $data = [
                    'type' => 'Board Item Update',
                    'new_data' => json_encode($payload),
                    'old_data' => json_encode($boardItem)
                ];
                $this->ActionLog($data);
            }
            
            DB::commit();
            return $boardItem;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return false;
        }
    }


    public function deleteBoard($id)
    {
        DB::beginTransaction();
        try {
            $board =  Board::where('id', $id)->first();

            if ($board) {
                $board->items()->delete();
                $board->delete();
                $data = [
                    'type' => 'Board Delete',
                    'old_data' => json_encode($board)
                ];
                $this->ActionLog($data);
            }
            DB::commit();
            return $boardItem;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return false;
        }
    }


    public function deleteBoardItem($id)
    {
        DB::beginTransaction();
        try {
            $boardItem =  BoardItem::where('id', $id)->first();

            if ($boardItem) {
                $boardItem->delete();
                $data = [
                    'type' => 'Board Item Delete',
                    'old_data' => json_encode($boardItem)
                ];
            }

            DB::commit();
            return $boardItem;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return false;
        }
    }
}
