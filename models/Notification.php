<?php


namespace app\models;


use app\core\App;
use app\core\db\DbModel;

class Notification extends DbModel
{
    public const CREATE_NOTIFICATION = 0;
    public const UPDATE_NOTIFICATION = 1;
    public const DELETE_NOTIFICATION = 2;

    public const UNSEEN_NOTIFICATION = 0;
    public const SEEN_NOTIFICATION = 1;

    public string $cat_id = '';
    public string $guideline_id = '';
    public string $date = '';
    public string $type = '';

    public static function tableName(): string
    {
        return 'notification';
    }

    public function attributes(): array
    {
        return ['cat_id','guideline_id','date','type'];
    }

    public static function primaryKey(): string
    {
        return 'not_id';
    }

    public function rules(): array
    {
//        return ['cat_id'=>[self::RULE_REQUIRED],
//            'post_id'=>[self::RULE_REQUIRED],
//            'date'=>[self::RULE_REQUIRED],
//            'post_date'=>[self::RULE_REQUIRED],
//            'type'=>[self::RULE_REQUIRED]
//        ];
        return [];
    }

    public static function getNotifications()
    {
        $user = App::$app->user->id;
        $SQL = "select n.not_id , c.cat_id,cat_title,guid_id ,status,type,date
                from notification n
                join categories c
                on c.cat_id = n.cat_id
                join notification_status ns
                on n.not_id = ns.not_id where c.cat_id in (SELECT cat_id FROM category_subscription where user_id = :user_id order by date DESC)";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id",$user);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function markAsRead($not_id)
    {
        $user = App::$app->user->id;
        $SQL = "update notification_status set status=1 where not_id = :not_id and user_id =:user_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id",$user);
        $statement->bindValue(":not_id",$not_id);
        $statement->execute();
    }

    public static function addNotification($cat_id,$guid_id,$type)
    {
        $SQL = "INSERT INTO notification(cat_id, guid_id, date, type) VALUES (:cat_id,:guid_id,:date,:type)";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id",$cat_id);
        $statement->bindValue(":guid_id",$guid_id);
        $statement->bindValue(":date", date("Y-m-d"));
        $statement->bindValue(":type",$type);
        $statement->execute();
        $not_id = self::lastInsertID();

        $SQL = "SELECT * FROM category_subscription WHERE cat_id=:cat_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id",$cat_id);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_COLUMN,1);
        $SQL = "";
        foreach ($users as $user){
            $SQL .= "INSERT INTO notification_status(user_id, not_id, status) VALUES ($user,$not_id,);";
        }

    }

}