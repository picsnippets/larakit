<?php

namespace Buckii\Larakit\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Kris\LaravelFormBuilder\FormBuilder;
use Buckii\Larakit\Contracts\FormProvider;
use Kris\LaravelFormBuilder\Form;

class Model extends EloquentModel implements FormProvider
{
    protected function formBuilder(): FormBuilder
    {
        return resolve('laravel-form-builder');
    }

    public function getCreateForm(): Form
    {
        return $this->formBuilder()->plain();
    }

    public function getEditForm(): Form
    {
        return $this->formBuilder()->plain();
    }
}
