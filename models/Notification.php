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

    public const GUIDELINE = 0;
    public const SUB_CATEGORY = 1;

    public string $cat_id = '';
    public string $cat_title = '';
    public string $date = '';
    public string $type = '';
    public string $status = '';
    public string $class = '';

    public static function tableName(): string
    {
        return 'notification';
    }

    public function attributes(): array
    {
        return ['cat_id', 'cat_title', 'date', 'type', 'status'];
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
        if (App::isGuest()){
            return [];
        }
        $user = App::$app->user->id;
        $SQL = "select n.not_id , c.cat_id, c.cat_title, ns.status, n.type, n.date , n.class from notification_status ns
                    join notification n
                    on ns.not_id = n.not_id
                    join categories c
                    on c.cat_id = n.cat_id
                    where user_id = :user_id  order by n.not_id DESC";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function markAsRead($not_id)
    {
        $user = App::$app->user->id;
        $SQL = "update notification_status set status=1 where not_id = :not_id and user_id =:user_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->bindValue(":not_id", $not_id);
        $statement->execute();
    }

    public static function addNotification($cat_id, $type, $class)
    {
        $SQL = "INSERT INTO notification(cat_id, date, type,class) VALUES (:cat_id,:date,:type,:class)";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id", $cat_id);
        $statement->bindValue(":date", date("Y-m-d"));
        $statement->bindValue(":type", $type);
        $statement->bindValue(":class", $class);
        $statement->execute();
        $not_id = self::lastInsertID();

        $SQL = "SELECT * FROM category_subscription WHERE cat_id=:cat_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id", $cat_id);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_COLUMN, 1);
        $SQL = "";
        if (count($users) > 0) {
            foreach ($users as $user) {
                $SQL .= "INSERT INTO notification_status(user_id, not_id, status) VALUES ($user,$not_id,0);";
            }
            $statement = self::prepare($SQL);
            $statement->execute();
        }

    }
}