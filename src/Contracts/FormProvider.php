<?php

namespace Buckii\Larakit\Contracts;

use Kris\LaravelFormBuilder\Form;

interface FormProvider
{
    public function getCreateForm(): Form;
    public function getEditForm(): Form;
}
