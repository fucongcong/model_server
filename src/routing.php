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
                'method' => 'getSpecialCache',
                'parameters' => ['$id', '$use_cache'],
            ],
            [
                'method' => 'addSpecial',
                'parameters' => ['$special'],
            ],
            [
                'method' => 'updateSpecial',
                'parameters' => ['$id', '$fields'],
            ],
            [
                'method' => 'deleteSpecial',
                'parameters' => ['$id'],
            ],

        ],

        'SpecialType' => [

            [
                'method' => 'addSpecialType',
                'parameters' => ['$special_id', '$type_id'],
            ],
            [
                'method' => 'getTypesById',
                'parameters' => ['$special_id'],
            ],
            [
                'method' => 'deleteType',
                'parameters' => ['$special_id'],
            ],
        ],

    ],


];