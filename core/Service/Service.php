<?php
namespace core\Service;

class Service
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