<?php
namespace src\Model\Special\Impl;

use src\Model\Special\SpecialModel;
use Model;

class SpecialModelImpl extends Model implements SpecialModel
{

    public function getSpecial($id)
    {
        return $id."asas";
    }

}
