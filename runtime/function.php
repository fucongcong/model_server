<?php

        
function Special_Special_getSpecial($id) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> getSpecial($id);
}


function Special_Special_getSpecialCache($id,$use_cache) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> getSpecialCache($id,$use_cache);
}


function Special_Special_addSpecial($special) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> addSpecial($special);
}


function Special_Special_updateSpecial($id,$fields) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> updateSpecial($id,$fields);
}


function Special_Special_deleteSpecial($id) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> deleteSpecial($id);
}


function Special_SpecialType_addSpecialType($special_id,$type_id) {

    $class = new src\Services\Special\Impl\SpecialTypeServiceImpl();
    return $class -> addSpecialType($special_id,$type_id);
}


function Special_SpecialType_getTypesById($special_id) {

    $class = new src\Services\Special\Impl\SpecialTypeServiceImpl();
    return $class -> getTypesById($special_id);
}


function Special_SpecialType_deleteType($special_id) {

    $class = new src\Services\Special\Impl\SpecialTypeServiceImpl();
    return $class -> deleteType($special_id);
}

