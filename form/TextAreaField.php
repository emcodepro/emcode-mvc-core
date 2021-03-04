<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 04-Mar-21
 * Time: 11:02
 */

namespace app\core\form;


class TextAreaField extends BaseInput
{

    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control %s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute});
    }
}