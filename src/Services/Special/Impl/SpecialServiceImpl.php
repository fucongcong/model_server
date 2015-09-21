<?php
namespace src\Services\Special\Impl;

use src\Services\Special\SpecialService;

class SpecialServiceImpl implements SpecialService
{

    public function getSpecial($id)
    {
        return $id."asas";
    }

    public function addSpecial($special,$name)
    {
        return $special.$name;
    }
}
