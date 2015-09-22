# 用于model层的RPC框架
##是基于swoole框架（Hprose）的基础上进行的业务扩展。良好的支持了数据层与服务层的数据吞吐。

####1.[框架使用的简介](#user-content-框架使用的简介)
- [安装](#user-content-安装)
- [目录结构](#user-content-目录结构)
- [1开放服务Service层](#user-content-1开放服务Service层)
- [2数据Model层](#user-content-2数据Model层)
- [3开放服务接口的配置](#user-content-3开放服务接口的配置)
- [4常用的函数介绍](#user-content-4常用的函数介绍)

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
    - routing.php （路由配置，需要暴露的接口）
- index.php(主入口，运行即可)
