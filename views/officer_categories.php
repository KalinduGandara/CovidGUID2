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
                        <?php
                        if (isset($_GET['edit_id'])) {
                            $category = \app\models\proxy\CategoryProxy::getById($_GET['edit_id']);
                            $model = $category->getCategoryObject();
                        } else $model = new \app\models\Category();
                        ?>

                        <?php $form = \app\core\form\Form::begin('', 'post') ?>
                        <?php echo $form->field($model, 'cat_title') ?>
                        <?php echo $form->textareaField($model, 'category_description') ?>
                        <button type="submit" class="btn btn-primary">Submit</button>

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

                            <?php
                            foreach (\app\models\proxy\CategoryProxy::getAll() as $category) {
                                $cat_id = $category->getCatId();
                                $cat_title = $category->getCatTitle();
                                $category_description = $category->getCategoryDescription();
                                echo "<tr>
                                            <td>$cat_id</td>
                                            <td>$cat_title</td>
                                            <td>$category_description</td>
                                            <td><a href=\"categories?edit_id=$cat_id\"><i class=\"ms-3 mt-2 fa fa-pencil\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Edit\"></i></a></td>
                                            <td><a href=\"categories?delete_id=$cat_id\"><i class=\"ms-3 mt-2 fa fa-minus-circle\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Delete\"></i></a></td>
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
