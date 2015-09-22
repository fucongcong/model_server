<?php
use core\Exceptions\NotFoundException;
use core\Config\Config;
use core\Cache\Cache;
use core\Model\Model;

function D($name) {

    static $_model = array();

    $names = explode(".", $name);
    $className = "";

    if(count($names) == 2) {

        $className = "src\\Model\\{$names[0]}\\Impl\\{$names[1]}ModelImpl";

    }

    if (!class_exists($className)) {

        throw new NotFoundException("Class ".$className." not found !");
    }

    if (!isset($_model[$names[1]]))
        $_model[$names[1]] = new $className();

    return $_model[$names[1]];

}

function M($name='', $class='Model') {
    static $_model = array();
    if (!isset($_model[$name]))
        $_model[$name] = new $class($name);
    return $_model[$name];
}

// 全局缓存设置和读取
function S($name, $value='', $expire='', $type='') {
    static $_cache = array();
    //取得缓存对象实例
    $cache = Cache::getInstance($type);
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            $result = $cache->rm($name);
            if ($result)
                unset($_cache[$type . '_' . $name]);
            return $result;
        }else {
            // 缓存数据
            $cache->set($name, $value, $expire);
            $_cache[$type . '_' . $name] = $value;
        }
        return;
    }
    if (isset($_cache[$type . '_' . $name]))
        return $_cache[$type . '_' . $name];
    // 获取缓存数据
    $value = $cache->get($name);
    $_cache[$type . '_' . $name] = $value;
    return $value;
}

function Service($name) {

    static $_service = array();

    $names = explode(".", $name);
    $serviceName = "";

    if(count($names) == 2) {

        $serviceName = "src\\Services\\{$names[0]}\\Impl\\{$names[1]}ServiceImpl";

    }

    if (!class_exists($serviceName)) {

        throw new NotFoundException("Class ".$serviceName." not found !");
    }

    if (!isset($_service[$names[1]]))
        $_service[$name] = new $serviceName();

    return $_service[$name];
}

function C($name) {

    return Config::get("app::{$name}");
}

function L($name) {

    return Config::get("language::{$name}");
}

// 设置和获取统计数据
function N($key, $step=0) {
    static $_num = array();
    if (!isset($_num[$key])) {
        $_num[$key] = 0;
    }
    if (empty($step))
        return $_num[$key];
    else
        $_num[$key] = $_num[$key] + (int) $step;
}

// 记录和统计时间（微秒）
function G($start, $end = '', $dec = 3) {
    static $_info = array();
    if (!empty($end)) {// 统计时间
        if (!isset($_info[$end])) {
            $_info[$end] = microtime(TRUE);
        }
        return number_format(($_info[$end] - $_info[$start]), $dec);
    } else {// 记录时间
        $_info[$start] = microtime(TRUE);
    }
}

// 取得对象实例 支持调用类的静态方法
function get_instance_of($name, $method='', $args=array()) {
    static $_instance = array();
    $identify = empty($args) ? $name . $method : $name . $method . to_guid_string($args);
    if (!isset($_instance[$identify])) {
        if (class_exists($name)) {
            $o = new $name();
            if (method_exists($o, $method)) {
                if (!empty($args)) {
                    $_instance[$identify] = call_user_func_array(array(&$o, $method), $args);
                } else {
                    $_instance[$identify] = $o->$method();
                }
            }
            else
                $_instance[$identify] = $o;
        }
        else
            halt(L('_CLASS_NOT_EXIST_') . ':' . $name);
    }
    return $_instance[$identify];
}

// 根据PHP各种类型变量生成唯一标识号
function to_guid_string($mix) {
    if (is_object($mix) && function_exists('spl_object_hash')) {
        return spl_object_hash($mix);
    } elseif (is_resource($mix)) {
        $mix = get_resource_type($mix) . strval($mix);
    } else {
        $mix = serialize($mix);
    }
    return md5($mix);
}

/**
 * from thinkphp
 * 字符串命名风格转换
 * type
 * =0 将Java风格转换为C的风格
 * =1 将C风格转换为Java的风格
 * @access protected
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type=0) {
    if ($type) {
        return ucfirst(preg_replace_callback("/_([a-zA-Z])/",function ($m){ return strtoupper($m[1]); }, $name));
    } else {
        $name = preg_replace("/[A-Z]/", "_\\0", $name);
        return strtolower(trim($name, "_"));
    }
}

