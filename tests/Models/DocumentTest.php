<?php

namespace Buckii\LarakitTests\Models;

use Buckii\LarakitTests\LarakitTestCase;
use Buckii\Larakit\Models\Document;
use Kris\LaravelFormBuilder\Form;

class DocumentTest extends LarakitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = new Document([
            'line_one' => '123 Main Street',
            'line_two' => '',
            'line_three' => '',
            'city' => 'Columbus',
            'state' => 'OH',
            'zip_code' => '43210',
        ]);
    }
}
