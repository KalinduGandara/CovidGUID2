<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo \app\core\App::$app->user->firstname; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div>
                    <strong><hr></strong>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header bg-danger">
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
                                <div class="card-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
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
                            <a href="/officer/subcategories">
                                <div class="card-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">
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
                                <div class="card-footer">
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


                    <div id="columnchart_material" style="height: 500px;"></div>
                </div>
                <!-- /Chart row -->

            </div>
        </div>
    </div>
</div>