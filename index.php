<?php
use core\Kernal;

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

define('__ROOT__', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require __ROOT__.'/vendor/hprose/hprose/src/Hprose.php';

require __ROOT__.'/core/Common/function.php';

$kernal = new Kernal('tcp');

$kernal->init();
