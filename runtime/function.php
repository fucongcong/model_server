<?php
use ReflectionClass;
        
function Special_Special_getSpecial($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('getSpecial');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_Special_getSpecialCache($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('getSpecialCache');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_Special_updateSpecial($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('updateSpecial');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_Special_deleteSpecial($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('deleteSpecial');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_Special_findSpecials($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('findSpecials');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_SpecialType_addSpecialType($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialTypeServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('addSpecialType');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_SpecialType_getTypesById($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialTypeServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('getTypesById');
    return $method->invokeArgs($instanc, $parameters);

}


function Special_SpecialType_deleteType($parameters) {

    $reflector = new ReflectionClass('src\Services\Special\Impl\SpecialTypeServiceImpl');

    $instanc =$reflector->newInstanceArgs();
    $method = $reflector->getmethod('deleteType');
    return $method->invokeArgs($instanc, $parameters);

}

