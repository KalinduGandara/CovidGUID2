<?php
$category_options = [];
foreach ($categories as $category) {
    $category_options[$category->getCatId()] = $category->getCatTitle();
}
$subcategory_options = [];
foreach ($subcategories as $subcategory) {
    if(isset($_GET['cat_id'])){
        if($subcategory->getCatId() === $_GET['cat_id'])
            $subcategory_options[$subcategory->getSubCategoryId()] = $subcategory->getSubCategoryName();
    }
    else{
        $subcategory_options[$subcategory->getSubCategoryId()] = $subcategory->getSubCategoryName();
    }
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/officer_navigation.php" ?>


    <?php
    //                    if (isset($_GET['source'])) {
    //                        $source = $_GET['source'];
    //                    }
    //                    else $source = '';
    //
    //                    switch ($source) {
    //                        case 'add_post':
    //                            include "includes/add_post.php";
    //                            break;
    //
    //                        case 'edit_post':
    //                            include "includes/edit_post.php";
    //                            break;
    //
    //                        default:
    //                            include "includes/view_all_posts.php";
    //                            break;
    //                    }

    ?>
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
                echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options,true, \app\models\SubCategory::findOne(['sub_category_id'=> $edit_guideline->getSubCategoryId()])->cat_id );
                echo $form->selectField($model, 'sub_category_id', $subcategory_options,true,$edit_guideline->getSubCategoryId() );

                echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                echo '<h5>Available guidelines: </h5>';

                $display_guidelines = array_filter($display_guidelines, function ($guideline) use($edit_guideline){
                    return $guideline->getSubCategoryId() === $edit_guideline->getSubCategoryId();
                });
                include 'components/officer_guideline.php';
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
                echo $form->checkbox($model,'guid_status');
            }
            else if(isset($_GET['cat_id'])){
                echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options,false, $_GET['cat_id'] );

                if(isset($_GET['sub_category_id'])){
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options,false, $_GET['sub_category_id']);

                    echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                    echo '<h5>Available guidelines: </h5>';

                    function filter_guideline($guideline){
                        return $guideline->getSubCategoryId() === $_GET['sub_category_id'];
                    }

                    $display_guidelines = array_filter($display_guidelines, "filter_guideline");
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr>
                            <th> Guideline </th>
                            <th> valid from </th>
                            <th> expires on </th>
                            <th> last modified </th>
                            </tr></thead>";
                    foreach($display_guidelines as $guideline){
                        $guid = new \app\views\components\guideline\OfficerGuideline($guideline);
                        echo $guid->getRenderString();
                    }
                    echo "</table>";
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
                    echo $form->checkbox($model,'guid_status');
                }
                else
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options);

            }

            else
                echo $form->selectField(new \app\models\SubCategory(), 'cat_id', $category_options);

            ?>
            <br />
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php $form->end(); ?>

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
