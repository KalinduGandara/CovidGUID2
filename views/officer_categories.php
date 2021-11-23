<?php

//if (!\app\core\App::isAdmin()) {
//    header("Location: /");
//}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/officer_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="container">
                <div class="col-xs-6">


                    <!--                    <form action="" method="post">-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label for="cat_title" class="form-label">Category name</label>-->
                    <!--                            <input type="text" class="form-control" name="cat_title" id="cat_title">-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group">-->
                    <!--                            <input type="submit" class="btn btn-primary" value="Add category" name="submit">-->
                    <!--                        </div>-->
                    <!--                    </form>-->

                    <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <?php echo $form->field($model, 'cat_title') ?>
                    <?php echo $form->textareaField($model, 'category_description') ?>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <?php \app\core\form\Form::end(); ?>
                    <!--                    --><?php //if ($mode == 'update') {
                                                ?>
                    <!---->
                    <!--                    --><?php //$form = \app\core\form\Form::begin('','post') 
                                                ?>
                    <!--                    --><?php //echo $form->field($model,'cat_title') 
                                                ?>
                    <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
                    <!---->
                    <!--                    --><?php //\app\core\form\Form::end();
                                                ?>
                    <!--                    --><?php //}
                                                ?>


                </div>

                <div class="col-xs-6">


                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category name</th>
                                <th>Category description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- query to get categories from database -->
                            <!--                                -->
                            <?php //get_all_categories();
                            //                                while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($categories as $row) {
                                $cat_id = $row["cat_id"];
                                $cat_title = $row["cat_title"];
                                $category_description = $row["category_description"];
                                echo "<tr>
                                            <td>$cat_id</td>
                                            <td>$cat_title</td>
                                            <td>$category_description</td>
                                            <td><a href='categories?delete_id=$cat_id'>Delete</a></td>
                                            <td><a href='categories?edit_id=$cat_id'>Edit</a></td>
                                            </tr>";
                            }


                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->