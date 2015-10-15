<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\GeoLocation\Model\Address;

class AddressTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Address::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Address::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'street' => 'Rua Real Grandeza',
                'number' => '62',
                'address_line' => '203',
                'district' => 'Botafogo',
                'city' => $faker->city,
                'province' => 'RJ',
                'country' => $faker->country,
                'zipcode' => $faker->zipcode,
            )
        );
        $result = Address::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Address::query($this->db, 'update', $record);
    }
}
