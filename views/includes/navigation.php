<?php use app\core\App;
use app\models\Notification;?>



<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/images/face-mask.png" height="32px" width="32px" class="me-2">COVIDGuide</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php if (isset($notifications) && !App::isGuest()){?>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Notifications
                        <?php
                        if (count($notifications)>0) {
                            ?>
                            <span class="badge badge-light"><?php echo $unseenNotifications; ?></span>
                            <?php
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="width: 36rem">
                        <div>
                        <?php
                        if (count($notifications) > 0) {
                            $count = 0;
                            foreach ($notifications as $notification) {
                                $id = $notification->cat_id;
                                $status = $notification->status;
                                ?>
                                <a style="
                                <?php
                                if ($notification->status == Notification::UNSEEN_NOTIFICATION) {
                                    echo "font-weight:bold;";
                                }
                                ?>
                                        " class="dropdown-item" href="notification?not_id=<?php echo $notification->not_id?>&cat_id=<?php echo $id?>">
                                    <small><i><?php echo date('F j, Y', strtotime($notification->date)) ?></i></small><br />
                                    <?php
                                    $title = $notification->cat_title;
                                    $class = match ($notification->class) {
                                        '0' => "Guideline",
                                        '1' => "Sub Category",
                                        default => "",
                                    };
                                    $type = match ($notification->type){
                                        Notification::CREATE_NOTIFICATION => "New",
                                        Notification::UPDATE_NOTIFICATION => "Update",
                                        Notification::DELETE_NOTIFICATION => "Delete",
                                        default => "",
                                    };
                                    echo "$type $class in $title";


                                    ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <?php
                                if ($count >=5) break;
                                $count++;
                            }?>
                            </div>
                            <div class="container">
                                <a class="float-start" href="/notification" style="text-decoration: none; cursor: pointer">View All</a>
                                <a class="float-end" href="/notification?not_id=all" style="text-decoration: none;cursor: pointer">Mark all as read</a>
                            </div>
                            <?php
                        }

                        else {
                            echo "No Records yet.";
                        }
                        ?>


                    </ul>
                </li>
                <?php }?>
                <?php if (! \app\core\App::isGuest()){ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                    <?php if (App::isAdmin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin</a>
                        </li>
                    <?php } ?>
                    <?php if (App::isOfficer()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/officer">Officer</a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </span>
        <?php if(App::isGuest()){?>
            <span class="navbar-text" style="margin-right: 40px">
                        <a href="/login" class="btn btn-warning rounded-pill text-white" style="margin: 0 5px"><b>Login</b></a>
                        <a href="/register" class="btn btn-danger rounded-pill text-white" style="margin: 0 5px"><b>Register</b></a>
                </span>
        <?php }else{ ?>
            <span class="navbar-text" style="margin-right: 40px">
                        <a href="/logout" class="btn btn-warning rounded-pill text-white" style="margin: 0 5px"><b>Logout</b></a>
                </span>
        <?php }?>
    </div>
    </div>
</nav>