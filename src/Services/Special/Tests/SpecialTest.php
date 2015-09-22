<?php
namespace src\Services\Special\Test;

use Test;

class SpecialTest extends Test
{
    //do test
    public function testGetSpecial(){

        $data = Service('Special.Special') -> getSpecial(48);

        $this->assertEquals(48, $data['special_id']);
    }
}
