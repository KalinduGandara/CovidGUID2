<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    public static function begin($action, $method, $aux=null)
    {
        if ($aux == null)
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        else
            echo sprintf('<form action="%s" method="%s" %s>', $action, $method, $aux);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute, bool $required= false)
    {
        return new InputField($model, $attribute, $required);
    }


    /**
     * @param Model $model
     * @param string $attribute
     * @param array $options Associative array ['value' => 'Display']
     * @return SelectField
     */
    public function selectField(?Model $model, string $attribute, array $options,bool $disabled=false, string $selected = '', bool $required = false)
    {
        return new SelectField($model,$attribute, $options,$disabled, $selected, $required);
    }

    public function textareaField(Model $model, $attribute){
        return new TextareaField($model,$attribute);
    }

    public function checkbox(Model $model, $attribute, string $value = null, bool $checked = false){
        return new CheckBox($model, $attribute, $value, $checked);
    }

}
