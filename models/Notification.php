<?php


namespace app\models;


use app\core\App;
use app\core\db\DbModel;

class Notification extends DbModel
{
    public static function tableName(): string
    {
        return 'notification';
    }

    public function attributes(): array
    {
        return ['cat_id','post_id','date','type'];
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

    public function getNotifications()
    {
        $user = App::$app->user;
    }

}