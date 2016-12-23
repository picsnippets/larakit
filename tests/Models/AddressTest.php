<?php

namespace Buckii\LarakitTests\Models;

use Buckii\LarakitTests\LarakitTestCase;
use Buckii\Larakit\Models\Address;
use Kris\LaravelFormBuilder\Form;

class AddressTest extends LarakitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = new Address([
            'line_one' => '123 Main Street',
            'line_two' => '',
            'line_three' => '',
            'city' => 'Columbus',
            'state' => 'OH',
            'zip_code' => '43210',
        ]);
    }

    public function testGetPrintableAddress()
    {
        $this->assertEquals(
            "Test\n123 Main Street\nColumbus, OH 43210",
            $this->model->getPrintableAddress('Test')
        );
    }

    public function testNewEmpty()
    {
        $addr = Address::newEmpty();

        $this->assertEquals('', $addr->line_one);
        $this->assertEquals('', $addr->line_two);
        $this->assertEquals('', $addr->line_three);
        $this->assertEquals('', $addr->city);
        $this->assertEquals('', $addr->state);
        $this->assertEquals('', $addr->zip_code);
    }

    public function testGetStatesIsArray()
    {
        $this->assertInternalType(
            'array',
            Address::getStates()
        );
    }
}
