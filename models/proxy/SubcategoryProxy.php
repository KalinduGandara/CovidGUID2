<?php

namespace app\models\proxy;

use app\core\App;
use app\models\SubCategory;

class SubcategoryProxy
{
    private string $sub_category_id;
    private string $sub_category_name;
    private string $cat_id;

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

    /**
     * @return SubCategory
     */
    public function getSubcategoryObject():SubCategory{
        return SubCategory::findOne(['sub_category_id' => $this->sub_category_id]);
    }

    /**
     * @return SubcategoryProxy[]
     */
    public static function getAll()
    {
        $tableName = 'sub_categories';
        $statement = App::$app->db->pdo->prepare("SELECT * FROM $tableName");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }


    /**
     * @param $where
     * @return SubcategoryProxy[]
     */
    public static function getAllWhere($where)
    {
        $tableName = 'sub_categories';
        $attribute = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr = :$attr",$attribute));
        $SQL = "SELECT * FROM $tableName WHERE $sql";

        $statement = App::$app->db->pdo->prepare($SQL);
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key",$value);
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param $id string
     * @return SubcategoryProxy
     */
    public static function getById(string $id)
    {
        $tableName = 'sub_categories';
        $SQL = "SELECT * FROM $tableName WHERE sub_category_id=$id";

        $statement = App::$app->db->pdo->prepare($SQL);
        $statement->execute();

        return $statement->fetchObject( static::class);
    }
}