<?php


namespace app\models;


class Category extends \app\core\db\DbModel
{
    public string $cat_title = '';

    public function save()
    {
        $this->cat_status = 0;
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'categories';
    }

    public function attributes(): array
    {
        return ['cat_title','cat_status'];
    }

    public static function primaryKey(): string
    {
        return 'cat_id';
    }

    public function rules(): array
    {
        return [
            'cat_title' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 8]]
        ];
    }
    public function labels(): array
    {
        return [
            'cat_title' => 'Category Title'
        ];
    }
}