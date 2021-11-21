<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }


    /**
     * @param Model $model
     * @param string $attribute
     * @param array $options Associative array ['value' => 'Display']
     * @return SelectField
     */
    public function selectField(Model $model, string $attribute, array $options)
    {
        return new SelectField($model,$attribute, $options);
    }

    public function textareaField(Model $model, $attribute){
        return new TextareaField($model,$attribute);
    }

}
