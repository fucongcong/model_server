<?php
namespace core\Service;
use core\Contracts\Service\Service as ServiceContract;

class Service implements ServiceContract
{
    public function getModel()
    {
        $class = get_called_class();

        $parts = explode('\\', $class);

        $model = $parts[2];

        $modelName = str_replace("ServiceImpl", "", $parts[4]);

        return D("{$model}.{$modelName}");

    }

}