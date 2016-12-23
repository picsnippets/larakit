<?php

namespace Buckii\LarakitTests\Models;

use Buckii\LarakitTests\LarakitTestCase;
use Buckii\Larakit\Models\Model;
use Kris\LaravelFormBuilder\Form;

class ModelTest extends LarakitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = new Model;
    }

    public function testGetCreateForm()
    {
        $this->assertInstanceOf(Form::class, $this->model->getCreateForm());
    }

    public function testGetEditForm()
    {
        $this->assertInstanceOf(Form::class, $this->model->getEditForm());
    }
}
