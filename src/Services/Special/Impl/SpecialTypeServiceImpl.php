<?php
namespace src\Services\Special\Impl;

use src\Services\Special\SpecialTypeService;
use Service;

class SpecialTypeServiceImpl extends Service implements SpecialTypeService
{

    public function addSpecialType($special_id, $type_id){

        return $this -> getModel() -> addSpecialType($special_id, $type_id);
    }

    public function getTypesById($special_id){

        return $this -> getModel() -> getTypesById($special_id);
    }

    public function deleteType($special_id){

        return $this -> getModel() -> deleteType($special_id);
    }

}
