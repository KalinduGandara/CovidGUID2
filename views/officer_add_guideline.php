<?php
$category_options = [];
foreach (\app\models\proxy\CategoryProxy::getAll() as $category) {
    $category_options[$category->getCatId()] = $category->getCatTitle();
}
$subcategory_options = [];
foreach (\app\models\proxy\SubcategoryProxy::getAll() as $subcategory) {
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
                if (isset($mode) && $mode === 'update') {
                    echo 'Edit Guideline';
                    $model = $edit_guideline;
                } else {
                    echo 'Add a Guideline';
                    $model = new \app\models\Guideline();
                }
                ?>
            </h1>
            <!-- /.row -->
            <div class="container">
                <?php
                $form = \app\core\form\Form::begin('', 'post');
                if(isset($_GET['edit_id'])){
                    echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options,true, \app\models\SubCategory::findOne(['sub_category_id'=> $edit_guideline->getSubCategoryId()])->cat_id );
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options,true,$edit_guideline->getSubCategoryId() );

                    echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                    echo '<h5>Available guidelines: </h5>';
                    \app\views\components\subcategory\SubcategoryBuilder::buildOfficerVeiw($model->getSubCategoryId())->render();
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

                        \app\views\components\subcategory\SubcategoryBuilder::buildOfficerVeiw($_GET['sub_category_id'])->render();
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
                        echo $form->selectField($model, 'sub_category_id', $subcategory_options);

                }

                else
                    echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options);

                ?>
                <br />
                <button type="submit" onclick="return validate()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>
                <?php $form->end(); ?>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
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

                function validate(){
                    const guideline = $('[name="guideline"]').val();
                    const activate_date = $('[name="activate_date"]').val();
                    const expiry_date = $('[name="expiry_date"]').val();
                    const guid_status = $('[name="guid_status"]').val();

                    //validation logic
                    let error;
                    if(guideline === '') error =  "Guideline field is empty";
                    else if(activate_date === '') error = "Activation date not given";

                    console.log(error);
                    return false;
                }

                function popUpAlert(msg){
                    $('body').append(
                        ``
                    );
                }

            </script>
        </div>
    </div>
</div>





