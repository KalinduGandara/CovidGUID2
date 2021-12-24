<?php

namespace app\core\form;

class CheckBox extends BaseField
{

    public function renderInput(): string
    {
        return sprintf('<input name="%s" type="checkbox" value="%s" class="form-check %s">',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '');
    }

    public function __toString()
    {
        return sprintf('
            <div class="mb-3">
                <span>%s %s</span>
                
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->renderInput(),
            $this->model->getLabels($this->attribute),
            $this->model->getFirstError($this->attribute));
    }


}