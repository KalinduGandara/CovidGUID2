<?php

$category_options = [];
foreach (\app\models\proxy\CategoryProxy::getAll() as $category) {
    $category_options[$category->getCatId()] = $category->getCatTitle();
}

?>

<div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "includes/officer_navigation.php" ?>
            <div class="col py-3 bg-white" style="margin-left: 250px">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                if(isset($_GET['edit_id'])){
                            ?>
                                <h1 class="page-header">
                                        Edit a Subcategory
                                </h1>
                            <?php } else
                                {
                                    ?>
                                    <h1 class="page-header">
                                    Subcategories
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
                                        <?php if(isset($_GET['status'])){?>
                                            <a href="/officer/subcategories" class="btn btn-secondary">Clear filters</a>
                                        <?php } ?>
                                        <a href="/officer/add-subcategory" class="btn btn-primary">Add new Sub Category</a>
                                    </div>
                                    <?php
                                    $form::end();
                                    ?>
                                    <hr>

                                    <?php
                                }
                                ?>

                        </div>
                    </div>


                    <div class="container">
                            <?php
                            if(isset($_GET['edit_id'])){
                            ?>
                        <div class="col-xs-6">


                            <?php $form = \app\core\form\Form::begin('', 'post') ?>
                            <?php echo $form->selectField($model, 'cat_id', $category_options, !($model->getCatId() === ''), $model->getCatId() ); ?>
                            <?php echo $form->field($model, 'sub_category_name') ?>
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <?php \app\core\form\Form::end(); ?>


                        </div>
                        <?php
                        }
                        ?>

                        <div class="col-xs-6">

                            <?php
                            if (isset($_GET['status']) && $_GET['status']==='1')
                                \app\views\components\subcategory\OfficerSubcategory::renderAllSubCategories('1');
                            else
                                \app\views\components\subcategory\OfficerSubcategory::renderAllSubCategories('0');

                            ?>
                        </div>
                    </div>

                </div>
                <script>
                    $(document).ready(()=>{
                        $('select[name="status"]').change(()=>{
                            window.location.href = "/officer/subcategories?status="+$('select[name="status"]').val();
                        });
                    });
                </script>
            </div>
        </div>
    </div>