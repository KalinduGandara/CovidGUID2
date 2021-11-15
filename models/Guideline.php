<?php


namespace app\models;


class Guideline extends \app\core\db\DbModel
{

    public static function tableName(): string
    {
        return 'guidelines';
    }

    public function attributes(): array
    {
        return [
            'guid_id',
            'guid_title',
            'guid_body',
            'cat_id',
            'guidd_status'
        ];
    }

    public static function primaryKey(): string
    {
        return 'guid_id';
    }

    public function rules(): array
    {
        return [
            'guid_id'=>[self::RULE_REQUIRED],
            'guid_title'=>[self::RULE_REQUIRED],
            'guid_body'=>[self::RULE_REQUIRED],
            'cat_id'=>[self::RULE_REQUIRED],
            'guidd_status'=>[self::RULE_REQUIRED],
        ];

    }
}
