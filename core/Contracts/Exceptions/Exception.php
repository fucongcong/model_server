<?php
namespace core\Contracts\Exceptions;

interface Exception
{
    /**
    * Custom pattern string output
    *
    * @return exception message
    */
    public function __toString();
}
