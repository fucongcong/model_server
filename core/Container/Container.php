<?php
namespace core\Container;

use ReflectionClass;
use Exception;
use core\Exceptions\NotFoundException;
use core\Contracts\Container\Container as ContainerContract;
use core\Config\Config;

class Container implements ContainerContract
{
    private static $_instance;

    protected $timezone;

    protected $environment;

    protected $appPath;

    protected $routing = [];


    public function init($routing)
    {
        $this -> setTimezone();
        $this -> setEnvironment();
        $this -> setAppPath();

        $this -> routing = $routing;

        $this -> buildFunction();
    }

    public function buildFunction()
    {
        $routing = $this -> routing;
        $functions = [];

        foreach ($routing as $modelName => $models) {

            foreach ($models as $serviceName => $serviceMethods) {

                $className = 'src\\Services\\'.$modelName.'\\Impl\\'.$serviceName.'ServiceImpl';

                foreach ($serviceMethods as $method) {

                    if($this -> checkFunction($className, $method)) {

                        $functionName = $modelName."_".$serviceName."_".$method;

                        $functions[$functionName] = [$className, $method];
                    }

                }
            }
        }

        $this -> createFunction($functions);

    }

    private function createFunction($functions)
    {
        $data = "<?php
use ReflectionClass;
        ";
        foreach ($functions as $key => $function) {

            $className = $function[0];
            $method = $function[1];
            $parameters = '$parameters';
            $var = "$";

            $data.= "
function {$key}({$parameters}) {

    {$var}reflector = new ReflectionClass('{$className}');

    {$var}instanc ={$var}reflector->newInstanceArgs();
    {$var}method = {$var}reflector->getmethod('{$method}');
    return {$var}method->invokeArgs({$var}instanc, {$parameters});

}

";
        }
        file_put_contents(__ROOT__."runtime/function.php", $data);
    }

    /**
     * build a moudle class
     *
     * @param  class
     * @return ReflectionClass class
     */
    public function buildMoudle($class)
    {
        if (!class_exists($class)) {

            throw new NotFoundException("Class ".$class." not found !");

        }

        $reflector = new ReflectionClass($class);

        return $reflector;
    }

    /**
     * do the moudle class action
     *
     * @param  class
     * @param  action
     */
    public function checkFunction($class, $method)
    {
        $reflector = $this->buildMoudle($class);
        if(!$reflector->hasMethod($method)) {

            throw new NotFoundException("Class ".$class." exist ,But the method ".$method." not found");
        }

        return true;
    }

    /**
     * return single class
     *
     * @return core\Group\Container Container
     */
    public static function getInstance(){

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }


    /**
     * 设置时区
     *
     */
    public function setTimezone()
    {
        $this -> timezone = Config::get('app::timezone');
        date_default_timezone_set($this -> getTimezone());
    }


    /**
     * 获取当前时区
     *
     */
    public function getTimezone()
    {
        return $this -> timezone;
    }

    /**
     * 设置环境
     *
     *@return string prod｜dev
     */
    public function getEnvironment()
    {
        return $this -> environment;
    }

    /**
     * 获取当前环境
     *
     */
    public function setEnvironment()
    {
        $this -> environment = Config::get('app::environment');
    }

    public function setAppPath()
    {
        $this -> appPath = __ROOT__;
    }

    public function getAppPath()
    {
        return $this -> appPath;
    }
}