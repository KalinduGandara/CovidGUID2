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
//    if (!\app\core\App::isAdmin()) {
//        header("Location: /");
//    }
//}

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/officer_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <small><?php echo \app\core\App::$app->user->firstname;?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="admin">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Home
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo sizeof(\app\models\proxy\CategoryProxy::getAll()) ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="/officer/categories">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo sizeof(\app\models\proxy\SubcategoryProxy::getAll()) ?></div>
                                    <div>Subcategories</div>
                                </div>
                            </div>
                        </div>
                        <a href="/officer/add-subcategory">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-medkit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo sizeof(\app\models\Guideline::getAll()) ?></div>
                                    <div>Guidelines</div>
                                </div>
                            </div>
                        </div>
                        <a href="/officer/guidelines">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Chart row -->
            <div class="row">


                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
            <!-- /Chart row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <!--        --><?php //include "includes/admin_footer.php" ?>



