<?php


namespace app\models;


use app\core\db\DbModel;
use app\core\UserModel;

class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETE = 2;

    public const ADMIN_USER = 0;
    public const OFFICER_USER = 1;
    public const PUBLIC_USER = 2;



    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public int $type = self::PUBLIC_USER;
    public string $password = '';
    public string $confirmPassword = '';

    public function save()
    {
        $this->status = $this->status != self::STATUS_INACTIVE ? $this->status : self::STATUS_INACTIVE;
        $this->type = $this->type != self::PUBLIC_USER ? $this->type : self::PUBLIC_USER;
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class'=>self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public static function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ['firstname','lastname','email','password' ,'status','type'];
    }
    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'type'=>'Role',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName() : string
    {
        return $this->firstname.' '.$this->lastname;
    }
}