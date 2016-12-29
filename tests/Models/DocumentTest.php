<?php

namespace Buckii\LarakitTests\Models;

use Buckii\LarakitTests\LarakitTestCase;
use Buckii\Larakit\Models\Document;
use Kris\LaravelFormBuilder\Form;
use Ramsey\Uuid\Uuid;

class DocumentTest extends LarakitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = new Document([
            'display_name' => Uuid::uuid4()->toString(),
            'stored_name' => Uuid::uuid4()->toString(),
            'mime_type' => 'text/plain',
            'extension' => 'txt',
        ]);
    }

    public function testSave()
    {
        $this->assertTrue($this->model->save());
    }
}
