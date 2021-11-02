<?php


namespace app\models;


class Category extends \app\core\db\DbModel
{

    public static function tableName(): string
    {
        return 'categories';
    }

    public function attributes(): array
    {
        return ['cat_title'];
    }

    public static function primaryKey(): string
    {
        return 'cat_id';
    }

    public function rules(): array
    {
        return [
            'cat_title' => [self::RULE_REQUIRED]
        ];
    }
}