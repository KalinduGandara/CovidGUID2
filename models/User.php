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
    public function update($id,$data)
    {
        $this->status = $this->status != self::STATUS_INACTIVE ? $this->status : self::STATUS_INACTIVE;
        $this->type = $this->type != self::PUBLIC_USER ? $this->type : self::PUBLIC_USER;
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        return parent::update($id,$data);
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
    public function deleteUser($id)
    {

        $SQL = "UPDATE users SET status=2 WHERE id=$id";

        $statement = self::prepare($SQL);


        try {
            return $statement->execute();
        }catch (\Exception $e){
            throw new \Exception("Something went Wrong",500);
        }
    }
    public function changeStatus($id)
    {
        $user = User::findOne(['id'=>$id]);

        $status  = $user->status;
        if ($status == self::STATUS_INACTIVE)
            $status = self::STATUS_ACTIVE;
        elseif ($status == self::STATUS_ACTIVE)
            $status = self::STATUS_INACTIVE;
//        echo '<pre>';
//        var_dump($this);
//        echo '</pre>';
//        exit();

        $SQL = "UPDATE users SET status=$status WHERE id=$id";
//        echo '<pre>';
//        var_dump($SQL);
//        var_dump($id);
//        echo '</pre>';
//        exit();

        $statement = self::prepare($SQL);
        try {
            return $statement->execute();
        }catch (\Exception $e){
            throw new \Exception("Something went Wrong",500);
        }
    }

}