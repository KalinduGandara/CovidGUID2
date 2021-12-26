<?php

namespace app\core\form;

use app\core\Model;

class CheckBox extends BaseField
{
    private string $value;
    public function __construct(Model $model, string $attribute, string $value)
    {
        parent::__construct($model, $attribute);
        $this->value = $value;
    }

    public function renderInput(): string
    {
        if ($this ->value === $this->model->{$this->attribute} ){
            return sprintf('<input name="%s" type="checkbox" checked value="%s" class="form-check-input %s">',
                $this->attribute,
                $this->value,
                $this->model->hasError($this->attribute) ? 'is-invalid' : '');
        }
        return sprintf('<input name="%s" type="checkbox" value="%s" class="form-check-input %s">',
            $this->attribute,
            $this->value,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '');
    }

    public function __toString()
    {
        return sprintf('
            <div class="mb-3 form-check">
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