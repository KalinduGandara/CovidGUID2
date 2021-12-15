<?php
$category_options = [];
foreach ($categories as $category) {
    $category_options[$category['cat_id']] = $category['cat_title'];
}
$subcategory_options = [];
foreach ($subcategories as $subcategory) {
    $subcategory_options[$subcategory['sub_category_id']] = $subcategory['sub_category_name'];
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
                $model = $guideline;
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
            echo $form->selectField($model, 'cat_id', $category_options);
            echo $form->selectField($model, 'sub_category_id', $subcategory_options);
            echo $form->textareaField($model, 'guidline');
            echo $form->selectField($model, 'guid_status', [0 => 'Active', 1 => 'Drafted']);
            ?>
            <br />
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php $form->end(); ?>

        </div>


    </div>
</div>
