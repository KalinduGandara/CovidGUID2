<?php


namespace app\models;


class Guideline extends \app\core\db\DbModel
{
    public string $cat_id = '';
    public string $sub_category_id = '';
    public string $guid_id = '';
    public string $guidline = '';
    public string $guid_status = '';

    public static function tableName(): string
    {
        return 'guidelines';
    }

    public function attributes(): array
    {
        return [
            'sub_category_id',
            'guidline',
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
            'guidline' => [self::RULE_REQUIRED],
            'cat_id' => [self::RULE_REQUIRED],
            'guid_status' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'sub_category_id' => "Select SubCategory",
            'guidline' => "Enter description",
            'cat_id' => "Select Category",
            'guid_status' => "Enter the status",
        ];
    }
}
