<?php


namespace app\models;


class Category extends \app\core\db\DbModel
{
    public string $cat_title = '';
    public string $category_description = '';
    public string $cat_id = '';


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
        return ['cat_title', 'cat_status', 'category_description'];
    }

    public static function primaryKey(): string
    {
        return 'cat_id';
    }

    public function rules(): array
    {
        return [
            'cat_title' => [self::RULE_REQUIRED],
            'category_description' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'cat_title' => 'Category Title',
            'category_description' => 'Category Description',
            'cat_id' => "Select Category",

        ];
    }

    /**
     * @return string
     */
    public function getCatTitle(): string
    {
        return $this->cat_title;
    }

    /**
     * @return string
     */
    public function getCategoryDescription(): string
    {
        return $this->category_description;
    }

    /**
     * @return string
     */
    public function getCatId(): string
    {
        return $this->cat_id;
    }


}
