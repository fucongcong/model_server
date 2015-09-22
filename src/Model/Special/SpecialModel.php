<?php
namespace src\Model\Special;

interface SpecialModel
{
    public function getSpecial($id);

    public function getSpecialCache($id, $use_cache = true);

    public function addSpecial($special);

    public function updateSpecial($id, $fields);

    public function deleteSpecial($id);

    public function findSpecials($condition, $orderBy, $start, $limit);

    public function getSpecialsCount($condition);

    public function findSpecialsByType($type, $limit = 5);

    public function findGroupSpecials(array $type, $limit = 5);

}