<?php
return [

    //模块名
    'Special' => [
        //该模块下得服务
        'Special' => [
            //该服务下提供的接口服务
            [
                'method' => 'getSpecial',
                'parameters' => ['$id'],
            ],

            [
                'method' => 'addSpecial',
                'parameters' => ['$special', '$name'],
            ]
        ],
        'SpecialType' => [

            [
                'method' => 'getSpecialType',
                'parameters' => ['$id'],
            ]
        ],

    ],


];