<?php
$category_options = [];
foreach (\app\models\proxy\CategoryProxy::filterDeleted() as $category) {
    $category_options[$category->getCatId()] = $category->getCatTitle();
}
$subcategory_options = [];
foreach (\app\models\proxy\SubcategoryProxy::getAllWhere(['sub_category_status'=>0]) as $subcategory) {
    if(isset($_GET['cat_id'])){
        if($subcategory->getCatId() === $_GET['cat_id'])
            $subcategory_options[$subcategory->getSubCategoryId()] = $subcategory->getSubCategoryName();
    }
    else{
        $subcategory_options[$subcategory->getSubCategoryId()] = $subcategory->getSubCategoryName();
    }
}
?>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <h1 class="page-header">
                <?php
                if (isset($_GET['edit_id'])) {
                    echo 'Edit Guideline';
                } else {
                    echo 'Add a Guideline';
                }
                ?>
            </h1>
            <hr>
            <!-- /.row -->
            <div class="container">
                <?php
                $form = \app\core\form\Form::begin('', 'post');
                if(isset($_GET['edit_id'])){
                    echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options,true, \app\models\SubCategory::findOne(['sub_category_id'=> $model->getSubCategoryId()])->cat_id );
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options,true,$model->getSubCategoryId() );

                    echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                    echo '<h5>Available guidelines: </h5>';
                    $guidelines = \app\views\components\subcategory\SubcategoryBuilder::buildOfficerVeiw($model->getSubCategoryId());
                    $guidelines->filterOutDeleted();
                    $guidelines->render();
                    echo '</div>';
                    echo $form->textareaField($model, 'guideline');
                    echo '<div class = "row">';
                    echo '<div class = "col">';
                    echo $form->field($model, 'activate_date')->dateField();
                    echo '</div>';
                    echo '<div class="col">';
                    echo $form->field($model,'expiry_date')->dateField();
                    echo '</div>';
                    echo '</div>';
                    echo $form->checkbox($model,'guid_status', '2');
                }
                else if(isset($_GET['cat_id'])){
                    echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options,false, $_GET['cat_id'] );

                    if(isset($_GET['sub_category_id'])){
                        echo $form->selectField($model, 'sub_category_id', $subcategory_options,false, $_GET['sub_category_id']);

                        echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                        echo '<h5>Available guidelines: </h5>';

                        $guidelines = \app\views\components\subcategory\SubcategoryBuilder::buildOfficerVeiw($_GET['sub_category_id']);
                        $guidelines->filterOutDeleted();
                        $guidelines->render();

                        echo '</div>';

                        echo $form->textareaField($model, 'guideline');
                        echo '<div class = "row">';
                        echo '<div class = "col">';
                        echo $form->field($model, 'activate_date')->dateField();
                        echo '</div>';
                        echo '<div class="col">';
                        echo $form->field($model,'expiry_date')->dateField();
                        echo '</div>';
                        echo '</div>';
                        echo $form->checkbox($model,'guid_status', '2');
                    }
                    else
                        echo $form->selectField($model, 'sub_category_id', $subcategory_options, required: true);

                }

                else
                    echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options, required: true);

                ?>
                <br />
                <button type="submit" class="btn btn-primary" >Submit</button>
                <?php $form->end(); ?>

                <!-- Modal To Show Errors -->
                <div id="popup" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Error !</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p id="guideline-error">...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(()=>{
                        $('select[name="cat_id"]').change(()=>{
                            window.location.href = "/officer/add-guideline?cat_id="+$('select[name="cat_id"]').val();
                        });

                        $('select[name="sub_category_id"]').change(()=>{
                            window.location.href = "/officer/add-guideline?cat_id="+$('select[name="cat_id"]').val()+"&sub_category_id="+$('select[name="sub_category_id"]').val();
                        });

                    });



                </script>

            </div>

        </div>
    </div>
</div>





