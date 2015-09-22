<?php
namespace src\Services\Special;

interface SpecialTypeService
{
    public function addSpecialType($special_id, $type_id);

    public function getTypesById($special_id);

    public function deleteType($special_id);
}

