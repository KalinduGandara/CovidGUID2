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
                                    $model = \app\models\SubCategory::findOne(['sub_category_id'=>$_GET['edit_id']]);
                            ?>
                                <h1 class="page-header">
                                    Edit a Subcategory
                                </h1>
                            <?php } else
                                {
                                    $model = new \app\models\SubCategory();
                                    ?>
                                    <h1 class="page-header">
                                        Add a Subcategory
                                    </h1>

                                    <?php
                                }
                                ?>

                        </div>
                    </div>
                    <hr>


                    <div class="container">
                        <div class="col-xs-6">

                            <?php $form = \app\core\form\Form::begin('', 'post', 'onsubmit="this.querySelectorAll(\'input\').forEach(i => i.disabled = false)"') ?>
                            <?php echo $form->selectField($model, 'cat_id', $category_options, !($model->getCatId() === ''), $model->getCatId() ); ?>
                            <?php echo $form->field($model, 'sub_category_name') ?>
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <?php \app\core\form\Form::end(); ?>


                        </div>

                        <div class="col-xs-6">


                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Subcategory name</th>
                                    <th>Category</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach (\app\models\proxy\SubcategoryProxy::getAll() as $subcategory) {
                                    $sub_category_id = $subcategory->getSubCategoryId();
                                    $sub_category_name = $subcategory->getSubCategoryName();
                                    $cat_id = $subcategory->getCatId();

                                    echo '<tr>
                                            <td>'.$sub_category_name.'</td>
                                            <td>'.$category_options[$cat_id].'</td>
                            
                                            <td><a href="add-subcategory?edit_id='.$sub_category_id.'"><i class="ms-3 mt-2 fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a></td>
                                            <td><a href="add-subcategory?delete_id='.$sub_category_id.'"><i class="ms-3 mt-2 fa fa-minus-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                                            </tr>';
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