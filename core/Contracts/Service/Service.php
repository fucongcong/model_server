<?php
namespace core\Contracts\Service;

interface Service
{
    /**
    * 获取一个实例化的Model
    *
    * @return core\Model Model
    */
    public function getModel();
}
