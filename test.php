<?php
use core\Config\Config;
use core\Handlers\AliasLoaderHandler;

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

define('__ROOT__', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require __ROOT__.'/core/Common/function.php';

$aliases = Config::get('app::aliases');
AliasLoaderHandler::getInstance($aliases) -> register();
