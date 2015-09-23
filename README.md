# 用于数据服务层使用的RPC框架
##支持分布式，支持TCP，HTTP协议。是基于Hprose的基础上进行的业务扩展。良好的支持了数据层与服务层的数据吞吐。支持thinkphp的model层的扩展

####1.[框架使用的简介](#user-content-框架使用的简介)
- [安装](#user-content-安装)
- [目录结构](#user-content-目录结构)
- [1开放服务Service层](#user-content-1开放服务Service层)
- [2数据Model层](#user-content-2数据Model层)
- [3开放服务接口的配置](#user-content-3开放服务接口的配置)
- [4常用的函数介绍](#user-content-4常用的函数介绍)
- [5单元测试](#user-content-5单元测试)

## 框架使用的简介
####环境依赖
- Swoole
- Redis
- PHP > 5.3

####安装
进入目录，执行以下命令

    git clone git@github.com:fucongcong/model_server.git

    composer install

####目录结构
- config (配置文件)
    - app.php （主要配置）
    - language.php （提示错误语言）
    - server.php（支持tcp,http,ws协议）
- core (框架核心代码)
- runtime (会缓存需要暴露的服务接口方法)
- src (主代码)
    - Model （模型层）
        - Special (示例)
            - Impl （模型层接口）
    - Services （服务层）
        - Special (示例)
            - Impl （服务层接口）
            - Tests（单元测试）
    - routing.php （路由配置，需要暴露的接口）
- index.php(主入口，运行即可)

####1开放服务Service层

####2数据Model层

####3开放服务接口的配置
src/routing.php（配置你所需要向外暴露的服务层的接口信息）
注意：如果改配置下得模块或者方法不存在时，会抛异常！或者参数配置错误，那么客户端调用接口服务时会报错！

    //模块名
    'Special' => [
        //该模块下得服务
        'Special' => [
            //该服务下提供的接口服务
            'getSpecial',
            'getSpecialCache',
            'updateSpecial',
            'deleteSpecial',
        ],

        'SpecialType' => [
            'addSpecialType',
            'getTypesById',
            'deleteType',
        ],

    ],

####4常用的函数介绍

(1) D() 获取一个实例化的自定义模型

    // 模块名   模型名            自定义方法  注：Thinkphp使用方法一致！
    D('Special.SpecialType') -> getTypesById($id);

(2) M() 获取一个实例化的模型

    // 模型名 注：Thinkphp使用方法一致！
    M('SpecialType')

(3) C() 获取配置

    //只能获取config/app.php中得配置
    C('environment')

    //如果需要获取config下所有文件得配置，可以这样
    use Config;
    Config::get('server::tcp');// get("文件名::配置名称")

(4) Service() 获取一个实例化的服务

    //和D方法类似
    Service('Special.Special') -> getTypesById($id);

(5) S() 调用缓存

    //和Thinkphp的S方法一致
    S('key', value, expireTime)

####5单元测试
    //测试服务层所有接口
    phpunit --bootstrap test.php src/
####6运行

    php index.php

    客户端模拟测试：
    php client。php
