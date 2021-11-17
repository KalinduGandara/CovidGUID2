<?php


namespace app\models;


class Guideline extends \app\core\db\DbModel
{
    public string $guid_title = '';
    public string $guid_body = '';
    public int $cat_id = 0;
    public string $guid_status = '';

    public static function tableName(): string
    {
        return 'guidelines';
    }

    public function attributes(): array
    {
        return [
            'guid_title',
            'guid_body',
            'cat_id',
            'guid_status'
        ];
    }

    public static function primaryKey(): string
    {
        return 'guid_id';
    }

    public function rules(): array
    {
        return [
            'guid_title'=>[self::RULE_REQUIRED],
            'guid_body'=>[self::RULE_REQUIRED],
            'cat_id'=>[self::RULE_REQUIRED],
            'guid_status'=>[self::RULE_REQUIRED],
        ];

    }

    public function labels():array
    {
        return [
            'guid_title'=>"Enter the title",
            'guid_body'=>"Enter description",
            'cat_id'=>"Enter category id",
            'guid_status'=>"Enter the status",
        ];
    }
}
