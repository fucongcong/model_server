<?php

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

require __DIR__.'/vendor/hprose/hprose/src/Hprose.php';

$client = new HproseSwooleClient('tcp://127.0.0.1:9394');
echo $client->Special_Special_addSpecial('12',"哈");