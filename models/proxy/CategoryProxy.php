<?php

namespace app\models\proxy;

use app\core\App;
use app\models\Category;

/**
 * Proxy Class for lazy loading
*/
class CategoryProxy
{
    private string $cat_id;
    private string $cat_title;
    private string $category_description;


    /**
     * @return CategoryProxy[]
     */
    public static function getAll()
    {
        $tableName = 'categories';
        $statement = App::$app->db->pdo->prepare("SELECT * FROM $tableName");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param $id string
     * @return CategoryProxy
     */
    public static function getById(string $id)
    {
        $tableName = 'categories';
        $SQL = "SELECT * FROM $tableName WHERE cat_id=$id";

        $statement = App::$app->db->pdo->prepare($SQL);
        $statement->execute();

        return $statement->fetchObject( static::class);
    }

    /**
     * @return string
     */
    public function getCatId(): string
    {
        return $this->cat_id;
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

    public function getCategoryObject():Category{
        return Category::findOne(['cat_id' => $this->cat_id]);
    }


}