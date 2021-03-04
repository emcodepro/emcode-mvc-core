<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 01-Mar-21
 * Time: 12:41
 */

namespace emcode\phpmvc\form;


class InputField extends BaseInput
{
    const TYPE_TEXT = 'text';
    const TYPE_NUMBER = 'number';
    const TYPE_EMAIL = 'email';
    const TYPE_PASSWORD = 'password';

    public $type;

    public function __construct($model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }


    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;

        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s"class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',);
    }
}