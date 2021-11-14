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
            <a class="navbar-brand" href="/">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
                        <?php
                        //                        $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
                        if(true){
                            ?>
                            <span class="badge badge-light"><?php echo 5; ?></span>
                            <?php
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php
                        //                        $query = "SELECT * from `notifications` order by `date` DESC";
                        $list = [['type'=>'comment','date'=>'2018-02-09 00:21:21']];
                        if(count($list)>0){
                            foreach($list as $i){
                                ?>
                                <a style ="
                                <?php
                                if($i['status']=='unread'){
                                    echo "font-weight:bold;";
                                }
                                ?>
                                        " class="dropdown-item" href="view.php?id=<?php echo $i['id'] ?>">
                                    <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                                    <?php

                                    if($i['type']=='comment'){
                                        echo "Someone commented on your post.";
                                    }else if($i['type']=='like'){
                                        echo ucfirst($i['name'])." liked your post.";
                                    }

                                    ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <?php
                            }
                        }else{
                            echo "No Records yet.";
                        }
                        ?>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav">

                <?php
//                echo "asd";

//                foreach ($categories as $category) {
//                    $cat_title = $category['cat_title'];
//                    echo "<li><a href='#'>$cat_title</a></li>";
//                }
                ?>


                <?php if (\app\core\App::isGuest()){ ?>

                <li>
                    <a href="login">Login</a>
                </li>
                    <li>
                        <a href="register">Register</a>
                    </li>
                <?php }else{?>
                    <?php if (\app\core\App::isAdmin()){ ?>
                        <li>
                            <a href="admin">Admin</a>
                        </li>
                    <?php }?>
                    <li>
                        <a href="logout">Logout</a>
                    </li>
                <?php }?>
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