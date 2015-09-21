<?php
namespace src\Services\Special;

interface SpecialService
{
    public function getSpecial($id);

    public function addSpecial($special,$name);
}

