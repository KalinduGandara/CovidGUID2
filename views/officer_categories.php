<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                        </h1>
                        <hr>
                    </div>
                </div>
                <!-- /.row -->
                <div class="container">

                            <?php \app\views\components\category\OfficerCategory::renderAllCategories()?>
                        </div>

            </div>
        </div>
    </div>
</div>
