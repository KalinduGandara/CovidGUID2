<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
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
                        <?php $form = \app\core\form\Form::begin('', 'post') ?>
                        <?php echo $form->field($model, 'cat_title') ?>
                        <?php echo $form->textareaField($model, 'category_description') ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Category name</th>
                                <th>Category description</th>
                            </tr>
                            </thead>
                            <tbody>

                            <!-- query to get categories from database -->
                            <!--                                -->
                            <?php
                            foreach (\app\models\Category::getAll() as $category) {
                                $cat_id = $category->getCatId();
                                $cat_title = $category->getCatTitle();
                                $category_description = $category->getCategoryDescription();
                                echo "<tr>
                                            <td>$cat_title</td>
                                            <td>$category_description</td>
                                            </tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
