<?php


namespace app\core\db;


use app\core\App;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function update($where,$data)
    {
        $tableName = $this->tableName();

        $attributes = array_filter(array_keys($data),array($this, 'isAttributes'));

        $str = array();
        foreach ($attributes as $value){
            array_push($str, "$value=:$value ");
        }
        $whereAttribute = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr = :$attr",$whereAttribute));
        $SQL = "UPDATE $tableName SET ".implode(',',$str)." WHERE $sql";

        $statement = self::prepare($SQL);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute",$data["$attribute"]);
        }
        foreach ($whereAttribute as $attribute) {
            $statement->bindValue(":$attribute",$where["$attribute"]);
        }

        try {
            return $statement->execute();
        }catch (\Exception $e){
            throw new \Exception("Something went Wrong",500);
        }
    }
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = array_filter($this->attributes(),array($this, 'checkParamsEmpty'));
        $params = array_map(fn($v)=>":$v",$attributes);
        $SQL = "INSERT INTO $tableName (".implode(',',$attributes).")VALUES(".implode(',',$params).")";
        $statement = self::prepare($SQL);

        foreach ($attributes as $attribute) {
            if (isset($this->{$attribute}))
                $statement->bindValue(":$attribute",$this->{$attribute});
        }
        $statement->execute();
        return true;
    }
    public function delete($where)
    {
        $tableName = $this->tableName();


        $whereAttribute = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr = :$attr",$whereAttribute));
        $SQL = "DELETE FROM $tableName WHERE $sql";

        $statement = self::prepare($SQL);

        foreach ($whereAttribute as $attribute) {
            $statement->bindValue(":$attribute",$where["$attribute"]);
        }

        try {
            return $statement->execute();
        }catch (\Exception $e){
            throw new \Exception("Something went Wrong",500);
        }
    }

    public static function findOne($where)//:self
    {
        $tableName = static::tableName();
        $attribute = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr = :$attr",$attribute));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key",$value);
        }

        try {
            $statement->execute();
            return $statement->fetchObject(static::class);
        }catch (\Exception $e){
            throw new \Exception("Item not Found",404);
        }
    }
    public static function getAllWhere($where)
    {
        $tableName = static::tableName();
        $attribute = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr = :$attr",$attribute));
        $SQL = "SELECT * FROM $tableName WHERE $sql";

        $statement = self::prepare($SQL);
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key",$value);
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
    public static function getAll()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function searchBy($where)
    {
        $tableName = static::tableName();
        $sql = "";
        foreach ($where as $key=>$value){
            $sql .= "$key LIKE '%$value%'";
        }

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';
//        exit();
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);

    }

    public static function lastInsertID()
    {
        return App::$app->db->pdo->lastInsertId();
    }

    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }

    public function checkParamsEmpty($attribute)
    {
        if (isset($this->{$attribute}))
            return true;
        return false;
    }

    private function isAttributes($attribute):bool
    {
        $attributes = $this->attributes();
        return in_array($attribute,$attributes);
    }
}
