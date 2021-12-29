<?php
$category_options = [];
foreach ($categories as $category) {
    $category_options[$category['cat_id']] = $category['cat_title'];
}
$subcategory_options = [];
foreach ($subcategories as $subcategory) {
    if(isset($_GET['cat_id'])){
        if($subcategory['cat_id'] === $_GET['cat_id'])
            $subcategory_options[$subcategory['sub_category_id']] = $subcategory['sub_category_name'];
    }
    else{
        $subcategory_options[$subcategory['sub_category_id']] = $subcategory['sub_category_name'];
    }
}
?>

<style>
    <?php include "../public/css/components/popupformStyles.css"; ?>
</style>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/officer_navigation.php"; ?>


    <div id="page-wrapper" class="container">
        <!-- Page Heading -->
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
                echo $form->selectField($model, 'cat_id', $category_options,true, $edit_guideline->cat_id );
                echo $form->selectField($model, 'sub_category_id', $subcategory_options,true,$edit_guideline->sub_category_id );

                $guid_id = $_GET['edit_id'];
                echo "<br><a href='/officer/show-guidelines?guid_id=$guid_id'>See currently available guidelines</a><br><br>";

                echo $form->textareaField($model, 'guideline');
                echo $form->selectField($model, 'guid_status', [0 => 'Active', 1 => 'Drafted'],false,$edit_guideline->guid_status);
            }
            else if(isset($_GET['cat_id'])){
                echo $form->selectField($model, 'cat_id', $category_options,false, $_GET['cat_id'] );

                if(isset($_GET['sub_category_id'])){
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options,false, $_GET['sub_category_id']);

                    $cat_id = $_GET['cat_id'];
                    $sub_category_id = $_GET['sub_category_id'];
                    echo "<br><a href='/officer/show-guidelines?cat_id=$cat_id&sub_category_id=$sub_category_id'> See currently available guidelines </a><br><br>";

                    echo $form->textareaField($model, 'guideline');
                    echo $form->selectField($model, 'guid_status', [0 => 'Active', 1 => 'Drafted']);


                }
                else
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options);

            }

            else
                echo $form->selectField($model, 'cat_id', $category_options);

            ?>
            <br />
            <button type="submit" class="btn btn-primary" onclick="openForm()">Submit</button>

            <?php
                include "components/popupForm.php";
                $form->end(); ?>

        </div>

        <script>
            <?php include "../public/js/components/popupformScript.js";?>

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
