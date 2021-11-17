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
        ?>
        <div class="container">
        <?php
        $form = \app\core\form\Form::begin('', 'post');
        echo $form->field($model, 'guid_title');
        //        echo $form->field($model, 'guid_body');
        ?>
        <fieldset>
            <legend><h5><b>Guideline Description</b></h5></legend>
            <div class="container" id="body">
                <div class="row">
                    <div class="col-xs-6">
                        <h5 class="text-center">Property</h5>
                    </div>
                    <div class="col-xs-6">
                        <h5 class="text-center">Value</h5>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addNewField()">Add a Field</button>
            <script>
                function addNewField() {
                    const div = document.createElement('div');

                    div.className = 'row';

                    div.innerHTML = `
                <div class="row">
                    <div class="col-xs-6">
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control">
                    </div>
                </div>
  `;

                    document.getElementById('body').appendChild(div);
                }

            </script>
        </fieldset>
        <?php
        echo $form->field($model, 'cat_id');
        echo $form->field($model, 'guid_status');
        ?>
        <br/>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php $form::end(); ?>

        </div>


    </div>
</div>


