<?php


namespace app\models;


use app\core\App;
use app\core\db\DbModel;
use app\core\UserModel;

class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETE = 2;

    public const ADMIN_USER = '0';
    public const OFFICER_USER = '1';
    public const PUBLIC_USER = '2';


    public string $id = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $type = '';
    public string $password = '';
    public string $confirmPassword = '';
    //TODO
//    public int $unseenNotifications = 0;
//    public array $notifications = [];
//    private array $subscribeList = [];

    public function subscribe($cat_id)
    {
        $user = $this->id;
        $SQL = "INSERT INTO category_subscription(cat_id,user_id) VALUES (:cat_id,:user_id)";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id", $cat_id);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
    }

    public function unsubscribe($cat_id)
    {
        $user = $this->id;
        $SQL = "DELETE FROM category_subscription WHERE cat_id=:cat_id AND user_id=:user_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":cat_id", $cat_id);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
    }
    public function subscribeAll()
    {
        $user = $this->id;
        $SQL = "DELETE FROM category_subscription WHERE user_id = :user_id;
                INSERT INTO category_subscription(cat_id, user_id) SELECT cat_id , :user_id FROM categories";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
    }

    public function unsubscribeAll()
    {
        $user = $this->id;
        $SQL = "DELETE FROM category_subscription WHERE user_id = :user_id;";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
    }

    public function isSubscribed(): bool
    {
        $user = $this->id;
        $SQL = "SELECT COUNT(cat_id) FROM category_subscription WHERE user_id = :user_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN,0)[0]>0;
    }

    public function save()
    {
        $this->status = $this->status != self::STATUS_INACTIVE ? $this->status : self::STATUS_INACTIVE;
        $this->type = $this->type != self::PUBLIC_USER ? $this->type : self::PUBLIC_USER;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    public function update($id, $data)
    {
        $this->status = $this->status != self::STATUS_INACTIVE ? $this->status : self::STATUS_INACTIVE;
        $this->type = $this->type != self::PUBLIC_USER ? $this->type : self::PUBLIC_USER;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return parent::update($id, $data);
    }


    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'type' => [self::RULE_REQUIRED],
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
        return ['firstname', 'lastname', 'email', 'password', 'status', 'type'];
    }
    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'type' => 'Role',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function deleteUser($id)
    {

        $SQL = "UPDATE users SET status=2 WHERE id=$id";

        $statement = self::prepare($SQL);


        try {
            return $statement->execute();
        } catch (\Exception $e) {
            throw new \Exception("Something went Wrong", 500);
        }
    }
    public function changeStatus($id)
    {
        $user = User::findOne(['id' => $id]);

        $status  = $user->status;
        if ($status == self::STATUS_INACTIVE)
            $status = self::STATUS_ACTIVE;
        elseif ($status == self::STATUS_ACTIVE)
            $status = self::STATUS_INACTIVE;

        $SQL = "UPDATE users SET status=$status WHERE id=$id";

        $statement = self::prepare($SQL);
        try {
            return $statement->execute();
        } catch (\Exception $e) {
            throw new \Exception("Something went Wrong", 500);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getSubscribeList(): array
    {
        if (App::isGuest()) return [];
        $user = $this->id;
        $SQL = "SELECT * FROM category_subscription WHERE user_id = :user_id";
        $statement = self::prepare($SQL);
        $statement->bindValue(":user_id", $user);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN, 0);
    }


    public function getPassword(): string
    {
        return $this->password;
    }
}
