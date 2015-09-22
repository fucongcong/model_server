<?php
namespace core\Cache;
use Exception;

class Cache{
    protected $connected;

    protected $handler;

    protected $prefix = '~@';

    protected $options = array();

    protected $type;

    protected $expire;

    public function connect($type = '', $options = array()) {
        if (empty($type))
            $type = C('DATA_CACHE_TYPE');

        $cacheClass = "core\\Cache\\Cache".$type;
        if (class_exists($cacheClass))
            $cache = new $cacheClass($options);
        else
            throw new Exception(L('_CACHE_TYPE_INVALID_') . ':' . $type);
        return $cache;
    }

    public function __get($name) {
        return $this -> get($name);
    }

    public function __set($name, $value) {
        return $this -> set($name, $value);
    }

    public function __unset($name) {
        $this -> rm($name);
    }

    public function setOptions($name, $value) {
        $this -> options[$name] = $value;
    }

    public function getOptions($name) {
        return $this -> options[$name];
    }

    static function getInstance() {
        $param = func_get_args();
        return get_instance_of(__CLASS__, 'connect', $param);
    }

}
?>