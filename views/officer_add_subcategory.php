<?php

$category_options = [];
foreach (\app\models\proxy\CategoryProxy::filterDeleted() as $category) {
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
                         <h1 class="page-header">
                                    Add a Subcategory
                                </h1>
<!--                            --><?php //$model = new \app\models\SubCategory(); ?>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-xs-6">
                            <?php $form = \app\core\form\Form::begin('', 'post') ?>
                            <?php echo $form->selectField($model, 'cat_id', $category_options, !($model->getCatId() === ''), $model->getCatId() ); ?>
                            <?php echo $form->field($model, 'sub_category_name') ?>
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <?php \app\core\form\Form::end(); ?>
                            <hr>


                        </div>

                        <div class="col-xs-6">


                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Subcategory name</th>
                                    <th>Category</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach (\app\models\proxy\SubcategoryProxy::getAllWhere(['sub_category_status'=>0]) as $subcategory) {
                                    $sub_category_id = $subcategory->getSubCategoryId();
                                    $sub_category_name = $subcategory->getSubCategoryName();
                                    $cat_id = $subcategory->getCatId();
                                    if (isset($category_options[$cat_id]))

                                    echo "<tr>
                                            <td>$sub_category_name</td>
                                            <td>$category_options[$cat_id]</td>
                                            </tr>";
                                }


                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>