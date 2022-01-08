<?php


namespace app\core\form;


use app\core\Model;

class SelectField extends BaseField
{
    private array $options;
    private bool $disabled;
    private string $selected;

    /**
     * @param Model $model
     * @param string $attribute
     * @param array $options Associative array ['value' => 'Display']
     * @param bool $disabled
     * @param string $selected
     */
    public function __construct(?Model $model, string $attribute ,array $options,bool $disabled = false, string $selected = '')
    {
        $this->options = $options;
        $this->attribute = $attribute;
        $this->disabled = $disabled;
        $this->selected = $selected;
        parent::__construct($model, $attribute);
    }


    public function renderInput(): string
    {
        $options = '';
        if($this->selected === ''){
            $options .= '<option selected disabled>' . '--- select ---'. '</option>';
        }
        foreach ($this->options as $value => $display){
            if ($value == $this->selected) {
                $options .= '<option selected value="' . $value . '">' . $display . '</option>';
            }
            else {
                $options .= '<option value="' . $value . '">' . $display . '</option>';
            }
        }

        if($this->model === null){
            return sprintf('<select name="%s" class="form-control" %s>
                        '.
                $options
                .'</select>',
                $this->attribute,
                $this->disabled?"disabled":'');
        }

        return sprintf('<select name="%s"  value="%s" class="form-control %s" %s>
                        '.
                                $options
                                .'</select>',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->disabled?"disabled":'');
    }

    public function select(string $value):void{
        $this->selected = $value;
    }
}
