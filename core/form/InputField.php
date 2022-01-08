<?php


namespace app\core\form;


use app\core\Model;

class InputField extends BaseField
{
    private const TYPE_TEXT = 'text';
    private const TYPE_PASSWORD = 'password';
    private const TYPE_NUMBER = 'number';
    private const TYPE_DATE = 'date';


    public string $type;


    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model,$attribute);
    }



    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function dateField(){
        $this->type = self::TYPE_DATE;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input name="%s" type="%s" value="%s" class="form-control %s">',
            $this->attribute,
            $this->type,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '');
    }
}
