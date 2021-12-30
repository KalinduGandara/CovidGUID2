<?php use app\core\App;
use app\models\Notification;?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">COVID Guide</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if (isset($notifications) && !App::isGuest()){?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
                        <?php
                        //                        $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
                        if (count($notifications)>0) {
                        ?>
                            <span class="badge badge-light"><?php echo $unseenNotifications; ?></span>
                        <?php
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php
                        //                        $query = "SELECT * from `notifications` order by `date` DESC";
//                        $list = [['type' => 'comment', 'date' => '2018-02-09 00:21:21']];
                        if (count($notifications) > 0) {
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
                                        " class="dropdown-item" href="?cat_id=<?php echo $id?> & read=<?php echo $status?> & not_id=<?php echo $notification->not_id?>">
                                    <small><i><?php echo date('F j, Y', strtotime($notification->date)) ?></i></small><br />
                                    <?php
                                    $title = $notification->cat_title;
                                    $class = match ($notification->class) {
                                        '0' => "Guideline",
                                        '1' => "Sub Category",
                                        default => "",
                                    };
                                    if ($notification->type == Notification::CREATE_NOTIFICATION) {
                                        echo "New $class in $title";
                                    } else if ($notification->type == Notification::UPDATE_NOTIFICATION) {
                                        echo "Update $class in $title";
                                    }else if ($notification->type == Notification::DELETE_NOTIFICATION) {
                                        echo "Delete $class in $title";
                                    }

                                    ?>
                                </a>
                                <div class="dropdown-divider"></div>
                        <?php
                            }
                        } else {
                            echo "No Records yet.";
                        }
                        ?>
                    </div>
                </li>
                <?php }?>
            </ul>
            <ul class="nav navbar-nav">

                <?php
                //                echo "asd";

                //                foreach ($categories as $category) {
                //                    $cat_title = $category['cat_title'];
                //                    echo "<li><a href='#'>$cat_title</a></li>";
                //                }
                ?>


                <?php if (App::isGuest()) { ?>

                    <li>
                        <a href="/login">Login</a>
                    </li>
                    <li>
                        <a href="/register">Register</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="/profile">Profile</a>
                    </li>
                    <?php if (App::isAdmin()) { ?>
                        <li>
                            <a href="/admin">Admin</a>
                        </li>
                    <?php } ?>
                    <?php if (App::isOfficer()) { ?>
                        <li>
                            <a href="/officer">Officer</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="/logout">Logout</a>
                    </li>
                <?php } ?>
                <?php
                if (isset($_GET['post_id'])) {
                    $edit_post_id = $_GET['post_id'];
                    echo "<li><a href='admin/posts?source=edit_post&edit_id=$edit_post_id'>Edit</a></li>";
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>