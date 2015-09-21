<?php
namespace core;
use core\Config\Config;
use core\Container\Container;
use core\Handlers\AliasLoaderHandler;
use HproseSwooleServer;

class Kernal
{
    protected $server_type;

    public function __construct($server_type)
    {

        $this -> aliasLoader();

        $this -> server_type = $server_type;
    }

    public function init()
    {
        $routing = require(__ROOT__."src/routing.php");

        $server_type = $this -> server_type;

        $server = Config::get("server::{$server_type}");

        $server = $server_type."://".$server['host'].":".$server['port']."/";
        $server = new HproseSwooleServer($server);

        //init function
        Container::getInstance() -> init($routing);

        require(__ROOT__."src/function.php");
        $this -> matchRoute($routing, $server);

        $server->start();
    }

    public function aliasLoader()
    {
        $aliases = Config::get('app::aliases');
        AliasLoaderHandler::getInstance($aliases) -> register();

    }

    public function matchRoute($routing, $server)
    {

        foreach ($routing as $modelName => $models) {

            foreach ($models as $serviceName => $serviceMethods) {

                foreach ($serviceMethods as $method) {

                   $functionName = $modelName."_".$serviceName."_".$method['method'];
                   $server->addFunction($functionName);
                }
            }
        }
    }
}
