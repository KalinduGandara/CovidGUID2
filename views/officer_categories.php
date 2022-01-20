<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                            <?php if (isset($_GET['edit_id'])){?>
                            <h1 class="page-header">
                                Edit Category
                            </h1>
                            <?php }else{?>
                            <h1 class="page-header">
                                Categories
                            </h1>
                                <?php
                                $form = \app\core\form\Form::begin('', 'get');
                                $filter =  $form->selectField(null, 'status', [
                                    '0' => 'Active',
                                    '1' => 'Deleted',
                                ]);
                                if(isset($_GET['status'])){
                                    $filter->select($_GET['status']);
                                }
                                echo $filter;
                                ?>
                                <div>
                                    <button type="submit" class="btn btn-success">Apply</button>
                                    <?php if(isset($_GET['status'])){?>
                                        <a href="/officer/categories" class="btn btn-secondary">Clear filters</a>
                                    <?php }?>
                                    <a href="/officer/add-category" class="btn btn-primary">Add New Category</a>
                                </div>
                                <?php
                                $form::end();
                                ?>
                                <hr>
                            <?php }?>
                        <hr>
                    </div>
                </div>
                <!-- /.row -->
                <div class="container">

                            <?php
                            if (isset($_GET['status']) && $_GET['status']==='1')
                                \app\views\components\category\OfficerCategory::renderAllCategories('1');
                            else
                                \app\views\components\category\OfficerCategory::renderAllCategories('0');
                            ?>
                        </div>

            </div>
        </div>
    </div>
</div>
