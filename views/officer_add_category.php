<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php if(isset($_GET['edit_id'])){
                                echo 'Edit Category';
                            }
                            else{
                                echo 'Add a Category';
                            }
                            ?>
                        </h1>
                        <hr>
                    </div>
                </div>
                <!-- /.row -->
                <div class="container">
                    <div>
                        <?php $form = \app\core\form\Form::begin('', 'post') ?>
                        <?php echo $form->field($model, 'cat_title') ?>
                        <?php echo $form->textareaField($model, 'category_description') ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <hr>
                    <div>
                        <?php \app\views\components\category\OfficerCategory::renderAllCategories('0')?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
