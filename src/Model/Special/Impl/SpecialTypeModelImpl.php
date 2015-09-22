<?php
namespace src\Model\Special\Impl;

use src\Model\Special\SpecialTypeModel;
use Model;

class SpecialTypeModelImpl extends Model implements SpecialTypeModel
{

    public function addSpecialType($special_id, $type_id) {

        $data['special_id'] = $special_id;
        $data['type_id'] =$type_id;

        return $this -> data($data) -> add();
    }

    public function getTypesById($special_id) {

        return $this -> field('type_id') -> where(array('special_id' => $special_id)) -> select();
    }

    public function deleteType($special_id) {

        return $this -> where(array('special_id' => $special_id)) -> delete();
    }

}