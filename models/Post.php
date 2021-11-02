<?php


namespace app\models;


class Post extends \app\core\db\DbModel
{

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array
    {
        return ['post_category_id','post_title','post_author','post_date','post_image','post_content','post_tags','post_comment_count','post_status','post_last_edited'];
    }

    public static function primaryKey(): string
    {
        return 'post_id';
    }

    public function rules(): array
    {
        return ['post_category_id'=>[self::RULE_REQUIRED],
            'post_title'=>[self::RULE_REQUIRED],
            'post_author'=>[self::RULE_REQUIRED],
            'post_date'=>[self::RULE_REQUIRED],
            'post_image'=>[self::RULE_REQUIRED],
            'post_content'=>[self::RULE_REQUIRED],
            'post_tags'=>[self::RULE_REQUIRED],
            'post_comment_count'=>[self::RULE_REQUIRED],
            'post_status'=>[self::RULE_REQUIRED],
            'post_last_edited'=>[self::RULE_REQUIRED]];

    }
}