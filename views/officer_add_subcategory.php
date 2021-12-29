<?php

$category_options = [];
foreach ($categories as $category) {
    $category_options[$category['cat_id']] = $category['cat_title'];
}

?>

<style>
    <?php include "../public/css/components/popupformStyles.css"; ?>
</style>

<div id="wrapper">

    <?php include "includes/officer_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add a Subcategory
                    </h1>
                </div>
            </div>


            <div class="container">
                <div class="col-xs-6">

                    <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <?php echo $form->selectField($model, 'cat_id', $category_options, false, $model->cat_id); ?>
                    <?php echo $form->field($model, 'sub_category_name') ?>
                    <button type="submit" class="btn btn-primary" onclick="openForm()">Submit</button>

                    <?php include "components/popupForm.php"; ?>

                    <script>
                        function openForm(delete_id = null) {
                            document.getElementById("myForm").style.display = "block";
                            if(delete_id !== null)
                            {
                                document.getElementById("delete_id").value = delete_id;
                            }
                        }

                        function closeForm() {
                            document.getElementById("myForm").style.display = "none";
                        }
<!--                        --><?php //include "public/js/components/popupformScript.js"; ?>
                    </script>


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
                            foreach ($subcategories as $row) {
                                $sub_category_id = $row["sub_category_id"];
                                $sub_category_name = $row["sub_category_name"];
                                $cat_id = $row["cat_id"];

                                echo "<tr>
                                            <td>$sub_category_id</td>
                                            <td>$sub_category_name</td>
                                            <td>$category_options[$cat_id]</td>
                            
                                            <td><a href='add-subcategory?delete_id=$sub_category_id'>Delete</a></td>
                                            <td> <button type='button' class='btn btn-secondary' onclick='openForm($sub_category_id)'>Delete2</button> </td>
                                            <td><a href='add-subcategory?edit_id=$sub_category_id'>Edit</a></td>
                                            </tr>";
                            }


                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>