<?php


namespace app\core\form;


use app\core\Model;

class SelectField extends BaseField
{
//    public string $type;


//    /**
//     * Field constructor.
//     * @param Model $model
//     * @param string $attribute
//     */
//    public function __construct(Model $model, string $attribute)
//    {
//        $this->type = self::TYPE_TEXT;
//        parent::__construct($model, $attribute);
//    }

    public function renderInput(): string
    {

        return sprintf('<select name="%s"  value="%s" class="form-control %s">

                                </select>',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '');
    }
}