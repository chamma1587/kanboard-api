<?php

namespace App\Repository\Contracts;

interface BoardRepositoryInterface
{

    /**
    * @param String $model
    * @param String $uuid
    * @return item
    */
    public function getByUuid($model, $uuid);

    /**
    * @return collection
    */
    public function getAllBoards();

    /**
    * @param array $payload
    * @return collection
    */
    public function updateBoardData($payload);

    /**
    * @param array $payload
    * @return Boolean
    */
    public function addBoard($payload);

    /**
    * @param Int $id
    * @return Boolean
    */
    public function deleteBoard($id);

    /**
    * @param Int $id
    * @return Boolean
    */
    public function deleteBoardItem($id);
    
    /**
    * @param array $payload
    * @return Boolean
    */
    public function addBoardItem($payload);


    /**
    * @param array $payload
    * @param Int $id
    * @return collection
    */
    public function updateBoardItem($payload, $id);
}
