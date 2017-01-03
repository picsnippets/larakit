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
        $this->assertEquals(
            'Create',
            $this->model->getCreateForm()
            ->getField('submit')
            ->getOption('label')
        );
    }

    public function testGetEditForm()
    {
        $this->assertInstanceOf(Form::class, $this->model->getEditForm());
        $this->assertEquals(
            'Update',
            $this->model->getEditForm()
            ->getField('submit')
            ->getOption('label')
        );
    }

    public function testNewModelForm()
    {
        $form = $this->model->newModelForm();
        $this->assertInstanceOf(Form::class, $form);
        $this->assertEquals($this->model, $form->getModel());
    }
}
