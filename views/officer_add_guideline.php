
<?php

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
            Add a guideline
        </h1>
        <!-- /.row -->
        <?php
        $model = new \app\models\Guideline();
        $form = \app\core\form\Form::begin('','post');
        echo $form->field($model, 'guid_title');
        echo $form->field($model, 'guid_body');
        echo $form->field($model, 'cat_id');
        echo $form->field($model, 'guid_status');
        ?>
        <br/>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php $form::end(); ?>



    </div>
</div>


