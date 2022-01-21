<?php


namespace app\views\components\user;


use app\views\components\IComponent;

class User implements IComponent
{
    private const ACTIVE = '0';
    private const INACTIVE = '1';
    private const DELETE = '2';

    private \app\models\User $user;

    /**
     * User constructor.
     * @param \app\models\User $user
     */
    public function __construct(\app\models\User $user)
    {
        $this->user = $user;
    }


    function render(): void
    {
        echo $this->getRenderString();
    }

    function getRenderString(): string
    {
        $user_id = $this->user->getId();
        $user_firstname = $this->user->getFirstname();
        $user_lastname = $this->user->getLastname();
        $user_email = $this->user->getEmail();
        $user_status = match ($this->user->getStatus()) {
            \app\models\User::STATUS_ACTIVE => "Active",
            \app\models\User::STATUS_INACTIVE => "Inactive",
            \app\models\User::STATUS_DELETE => "Delete",
            default => '',
        };
        $user_role = match ($this->user->getType()) {
            \app\models\User::ADMIN_USER => "Admin",
            \app\models\User::OFFICER_USER => "Officer",
            \app\models\User::PUBLIC_USER => "Public User",
            default => '',
        };
        $view_type =  match ($this->user->getStatus()) {
            \app\models\User::STATUS_ACTIVE => "table-primary",
            \app\models\User::STATUS_INACTIVE => "table-warning",
            \app\models\User::STATUS_DELETE => "table-danger",
            default => '',
        };
        $render = '<tr class="'.$view_type.'">
                            <td>'.$user_firstname.'</td>
                            <td>'.$user_lastname.'</td>
                            <td>'.$user_email.'</td>
                            <td>'.$user_role.'</td>
                            <td>'.$user_status.'</td>';
        if (!($this->user->getStatus() == \app\models\User::STATUS_DELETE))
            $render .=      '<td><a  href="users?source=change_status&user_id='.$user_id.'"><i class="ms-3 mt-2 fa fa-print" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Status"></i></a></td>
                            <td><a href="users?source=edit_user&edit_user_id='.$user_id.'"><i class="ms-3 mt-2 fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a></td>
                            <td><a href="users?del_id='.$user_id.'"><i class="ms-3 mt-2 fa fa-minus-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                </tr>';

       return $render;
    }
}