<?php

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

require __DIR__.'/vendor/hprose/hprose/src/Hprose.php';

$client = new HproseSwooleClient('tcp://127.0.0.1:9399');

var_dump($client->Special_Special_getSpecial([48]));

$params = [
    array(),
    'ctime desc',
    0,
    8
];
var_dump($client->Special_Special_findSpecials($params));
