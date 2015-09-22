<?php
namespace src\Services\Special\Impl;

use src\Services\Special\SpecialService;
use Service;

class SpecialServiceImpl extends Service implements SpecialService
{
    public function getSpecial($id) {

        return $this -> getModel() -> getSpecial($id);
    }

    public function getSpecialCache($id, $use_cache = true){

        return $this -> getModel() -> getSpecialCache($id, $use_cache);
    }

    public function addSpecial($special){

        return $this -> getModel() -> addSpecial($special);
    }

    public function updateSpecial($id, $fields){

        return $this -> getModel() -> updateSpecial($id, $fields);
    }

    public function deleteSpecial($id){

        return $this -> getModel() -> deleteSpecial($id);
    }

    public function findSpecials($condition, $orderBy, $start, $limit){

        return $this -> getModel() -> findSpecials($condition, $orderBy, $start, $limit);
    }

    public function getSpecialsCount($condition){

        return $this -> getModel() -> getSpecialsCount($condition);
    }

    public function findSpecialsByType($type, $limit = 5){

        return $this -> getModel() -> findSpecialsByType($type, $limit);
    }

    public function findGroupSpecials(array $type, $limit = 5){

        return $this -> getModel() -> findGroupSpecials($type, $limit);
    }
}
