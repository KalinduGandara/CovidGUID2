<?php


namespace app\models;


class SubCategory extends \app\core\db\DbModel
{
    public string $sub_category_id = '';
    public string $sub_category_name = '';
    public string $cat_id = '';

    public function save()
    {
        //$this->cat_status = 0;
        return parent::save();
    }

    public static function tableName(): string
    {
        return 'sub_categories';
    }

    public function attributes(): array
    {
        return ['sub_category_name', 'category_id'];
    }

    public static function primaryKey(): string
    {
        return 'sub_category_id';
    }

    public function rules(): array
    {
        return [
            'sub_category_name' => [self::RULE_REQUIRED],
            'cat_id' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'cat_id' => 'Select Category',
            'sub_category_name' => 'Subcategory Name'
        ];
    }
    public static function getCategoryID($sub_cat_id)
    {
        $SQL = "SELECT cat_id FROM sub_categories WHERE sub_category_id = :sub_cat_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":sub_cat_id",$sub_cat_id);
        $statement->execute();
        return $statement->fetch()[0];
    }

    /**
     * @return string
     */
    public function getSubCategoryId(): string
    {
        return $this->sub_category_id;
    }

    /**
     * @return string
     */
    public function getSubCategoryName(): string
    {
        return $this->sub_category_name;
    }

    /**
     * @return string
     */
    public function getCatId(): string
    {
        return $this->cat_id;
    }


}
