<?php

namespace Buckii\Larakit\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Kris\LaravelFormBuilder\FormBuilder;
use Buckii\Larakit\Contracts\FormProvider;
use Kris\LaravelFormBuilder\Form;

class Model extends EloquentModel implements FormProvider
{
    /**
     * Get a new Form with model set to this Model.
     *
     * Useful as a base for building form types relating to the current Model.
     * Setting the model has to be done at form creation time, so we do it here
     * instead of with a setFormOptions() call later.
     *
     * @param $options array Additional form options to set at create time.
     */
    public function newModelForm($options = []): Form
    {
        $options['model'] = $this;

        $form = $this->formBuilder()->plain($options);

        return $form;
    }

    /**
     * Should return the base Form for the Model.
     *
     * Basically, this is the Form without a submit button.  This method is
     * used by the default create and edit form methods to build full forms.
     */
    public function getBaseForm(): Form
    {
        return $this->newModelForm();
    }

    /**
     * Get a create form for this model.
     *
     */
    public function getCreateForm(): Form
    {
        $form = $this->getBaseForm();

        $form->add('submit', 'submit', [
            'label' => 'Create',
        ]);

        return $form;
    }

    /**
     * Get an edit form for this model.
     *
     */
    public function getEditForm(): Form
    {
        $form = $this->getBaseForm();

        $form->add('submit', 'submit', [
            'label' => 'Update',
        ]);

        return $form;
    }

    /**
     * Convenience method to get access to a FormBuilder.
     *
     */
    protected function formBuilder(): FormBuilder
    {
        return resolve('laravel-form-builder');
    }
}
