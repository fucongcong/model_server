<?php
use core\Exceptions\NotFoundException;
use core\Config\Config;

function D($name) {

    $names = explode(".", $name);
    $className = "";

    if(count($names) == 2) {

        $className = "src\\Model\\{$names[0]}\\Impl\\{$names[1]}ModelImpl";

    }

    if (!class_exists($className)) {

        throw new NotFoundException("Class ".$className." not found !");
    }

    return new $className();

}

function C($name) {

    return Config::get("app.{$name}");
}