<?php
return [

    'DB_TYPE' => 'mysqli', // 数据库类型
    'DB_HOST' => "p:192.168.1.4", // 数据库服务器地址
    'DB_NAME' => 'banciyuan', // 数据库名称
    'DB_USER' => 'banciyuan', // 数据库用户名
    'DB_PWD' => 'banciyuan', // 数据库密码
    'DB_PORT' => '3306', // 数据库端口
    'DB_CHARSET' => 'utf8mb4', //数据库编码方式
    'DB_PREFIX' => 'bcy_', // 数据表前缀

    'DATA_CACHE_TYPE' => 'Redis',
    'DATA_CACHE_PREFIX' => 'bcy:cache:',

    'REDIS_HOST' => '192.168.1.4',
    'REDIS_PORT' => '6379',
    'REDIS_AUTH' => '',

    // prod|dev
    'environment' => 'prod',

    //时区
    'timezone' => 'Asia/Shanghai',

    //类的映射
    'aliases' => [

        'Config'    => 'core\Config\Config',
        'Container' => 'core\Container\Container',
        'Model' => 'core\Model\Model',
        'Service' => 'core\Service\Service',
    ],


];