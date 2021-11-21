<?php


namespace app\core\form;


use app\core\Model;

class SelectField extends BaseField
{
    private array $options;

    /**
     * @param Model $model
     * @param string $attribute
     * @param array $options Associative array ['value' => 'Display']
     */
    public function __construct(Model $model, string $attribute ,array $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute);
    }


    public function renderInput(): string
    {
        $options = '';
        foreach ($this->options as $value => $display){
            $options .= '<option value="'.$value.'">'.$display.'</option>';
        }

        return sprintf('<select name="%s"  value="%s" class="form-control %s">
                        <option selected disabled></option>'.
                                $options
                                .'</select>',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '');
    }
}
