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
                echo $form->selectField($model, 'cat_id', $category_options,true,$edit_guideline->cat_id );
                echo $form->selectField($model, 'sub_category_id', $subcategory_options,true,$edit_guideline->sub_category_id );

                echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                echo '<h5>Available guidelines: </h5>';

                $display_guidelines = array_filter($display_guidelines, function ($guideline) use($edit_guideline){
                    return $guideline['cat_id'] === $edit_guideline->cat_id && $guideline['sub_category_id'] === $edit_guideline->sub_category_id;
                });
                include 'components/officer_guideline.php';
                echo '</div>';
                echo $form->textareaField($model, 'guideline');
                echo $form->selectField($model, 'guid_status', [0 => 'Active', 1 => 'Drafted'],false,$edit_guideline->guid_status);
            }
            else if(isset($_GET['cat_id'])){
                echo $form->selectField($model, 'cat_id', $category_options,false, $_GET['cat_id'] );

                if(isset($_GET['sub_category_id'])){
                    echo $form->selectField($model, 'sub_category_id', $subcategory_options,false, $_GET['sub_category_id']);

                    echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                    echo '<h5>Available guidelines: </h5>';

                    function filter_guideline($guideline){
                        return $guideline['cat_id'] === $_GET['cat_id'] && $guideline['sub_category_id'] === $_GET['sub_category_id'];
                    }

                    $display_guidelines = array_filter($display_guidelines, "filter_guideline");
                    include 'components/officer_guideline.php';
                    echo '</div>';

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
