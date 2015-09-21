<?php

        
function Special_Special_getSpecial($id) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> getSpecial($id);
}


function Special_Special_addSpecial($special,$name) {

    $class = new src\Services\Special\Impl\SpecialServiceImpl();
    return $class -> addSpecial($special,$name);
}


function Special_SpecialType_getSpecialType($id) {

    $class = new src\Services\Special\Impl\SpecialTypeServiceImpl();
    return $class -> getSpecialType($id);
}

