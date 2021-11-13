<?php //include "../includes/db.php" ?>
<?php //include "includes/admin_header.php" ?>
<?php //include "functions.php" ?>
<?php //session_start() ?>

<?php

//if (!isset($_SESSION['password_mismatch']) && !isset($_SESSION['not_admin'])) {
//    header("Location: ../");
//}
//if ($_SESSION['password_mismatch'] == false && $_SESSION['not_admin'] == false) {
//    $username = $_SESSION['username'];
//} else {
//echo \app\core\App::isAdmin();
    if (!\app\core\App::isAdmin()) {
        header("Location: /");
    }
//}

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo \app\core\App::$app->user->firstname;?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- widgets row -->

                <?php
//                    $posts_query = "SELECT post_id FROM posts";
//                    $posts_result = mysqli_query($connection, $posts_query);
//                    confirmQuery($posts_query);
                    $posts_num = 1;
//                    mysqli_free_result($posts_result);
//
//                    $comments_query = "SELECT comment_id FROM comments";
//                    $comments_result = mysqli_query($connection, $comments_query);
//                    confirmQuery($comments_query);
                    $comments_num = 2;
//                    mysqli_free_result($comments_result);
//
//                    $users_query = "SELECT user_id FROM users";
//                    $users_result = mysqli_query($connection, $users_query);
//                    confirmQuery($users_query);
                    $users_num = 3;
//                    mysqli_free_result($users_result);
//
//                    $categories_query = "SELECT cat_id FROM categories";
//                    $categories_result = mysqli_query($connection, $categories_query);
//                    confirmQuery($categories_query);
                    $categories_num = 4;
//                    mysqli_free_result($categories_result);
                ?>
                                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $posts_num ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comments_num ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $users_num ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $categories_num ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--/ widgets row -->

                <?php
//                    $active_posts_query = "SELECT post_id FROM posts WHERE post_status='published'";
//                    $active_posts_result = mysqli_query($connection, $active_posts_query);
//                    confirmQuery($active_posts_query);
                    $active_posts_num = 9;
//                    mysqli_free_result($active_posts_result);
//
//                    $draft_posts_query = "SELECT post_id FROM posts WHERE post_status='draft'";
//                    $draft_posts_result = mysqli_query($connection, $draft_posts_query);
//                    confirmQuery($draft_posts_query);
                    $draft_posts_num = 8;
//                    mysqli_free_result($draft_posts_result);
//
//                    $active_comments_query = "SELECT comment_id FROM comments WHERE comment_status='approved'";
//                    $active_comments_result = mysqli_query($connection, $active_comments_query);
//                    confirmQuery($active_comments_query);
                    $active_comments_num =7;
//                    mysqli_free_result($active_comments_result);
//
//                    $pending_comments_query = "SELECT comment_id FROM comments WHERE comment_status='unapproved'";
//                    $pending_comments_result = mysqli_query($connection, $pending_comments_query);
//                    confirmQuery($pending_comments_query);
                    $pending_comments_num = 6;
//                    mysqli_free_result($pending_comments_result);

                    $x_axis = ['active posts', 'draft posts', 'categories', 'active comments', 'pending comments', 'users'];
                    $y_axis = [$active_posts_num, $draft_posts_num, $categories_num, $active_comments_num, $pending_comments_num, $users_num];
                ?>

                <!-- Chart row -->
                <div class="row">
                    
                    
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
                <!-- /Chart row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
                <?php for ($i=0; $i < 6; $i++){
                    echo "['{$x_axis[$i]}', {$y_axis[$i]}],";
                } ?>
                ]);

                var options = {
                chart: {
                    title: 'CMS stats',
                    subtitle: '',
                }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
                    </script>
<!--        --><?php //include "includes/admin_footer.php" ?>


    