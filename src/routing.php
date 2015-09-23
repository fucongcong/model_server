<?php
return [

    //模块名
    'Special' => [
        //该模块下得服务
        'Special' => [
            //该服务下提供的接口服务
            'getSpecial',
            'getSpecialCache',
            'updateSpecial',
            'deleteSpecial',
            'findSpecials',
        ],

        'SpecialType' => [
            'addSpecialType',
            'getTypesById',
            'deleteType',
        ],

    ],


];