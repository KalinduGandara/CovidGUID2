<?php


namespace app\models;


class Guideline extends \app\core\db\DbModel
{
    public string $sub_category_id = '';
    public string $guid_body = '';
    public string $cat_id = '';
    public string $guid_status = '';

    public static function tableName(): string
    {
        return 'guidelines';
    }

    public function attributes(): array
    {
        return [
            'sub_category_id',
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
            'sub_category_id' => [self::RULE_REQUIRED],
            'guid_body' => [self::RULE_REQUIRED],
            'cat_id' => [self::RULE_REQUIRED],
            'guid_status' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'sub_category_id' => "Select SubCategory",
            'guid_body' => "Enter description",
            'cat_id' => "Select Category",
            'guid_status' => "Enter the status",
        ];
    }
}
