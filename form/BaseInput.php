<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 04-Mar-21
 * Time: 10:52
 */

namespace app\core\form;


abstract class BaseInput
{
    public $model;
    public $attribute;

    public function __construct($model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('
         <div class="mb-3">
            <label class="form-label">%s</label>
            %s
            <div class="invalid-feedback">
              %s
            </div>
        </div>
        ',  $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute));
    }
}