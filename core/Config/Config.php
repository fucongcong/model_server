<?php
namespace core\Config;

use Exception;
use core\Contracts\Config\Config as ConfigContract;

class Config implements ConfigContract
{
    private static $_instance;

    protected $config = [];

    /**
    * 获取config下得值
    *
    * @param  configName,  name::key
    * @return string
    */
    public static function get($configName)
    {
        return  static::getInstance() -> read($configName);
    }

    /**
    * read config
    *
    * @param  configName,  name::key
    * @return array
    */
    public function read($configName)
    {
        $configName = explode('::', $configName);

        if (count($configName) == 2) {

            $config = $this -> checkConfig($configName[0], $configName[1]);

            return $config[$configName[1]];

        }

        return array();

    }

    /**
    * 设置config
    *
    * @param  array config
    */
    public function setConfig($config)
    {
        $this -> config = array_merge($this -> config, $config);
    }

    /**
    * 获取config
    *
    * @return array
    */
    public function getConfig()
    {
        return $this -> config;
    }

    /**
    * return single class
    *
    * @return core\Config Config
    */
    public static function getInstance()
    {

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function checkConfig($key, $value)
    {
        $config = $this -> config;

        if (!isset($config[$key])) {

            $app = require(__ROOT__."config/".$key.".php");

            $this -> config = array_merge($this -> config, $app);

        }

        return $this -> config;
    }

}