<?php


namespace app\models;


use app\core\App;
use app\core\db\DbModel;

class Notification extends DbModel
{
    public const CREATE_NOTIFICATION = 0;
    public const UPDATE_NOTIFICATION = 1;
    public const DELETE_NOTIFICATION = 2;

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
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        exit();
    }

}