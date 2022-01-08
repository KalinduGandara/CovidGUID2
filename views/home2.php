<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                New Normal Guidelines
            </h1>

            <!-- Display Categories -->

            <?php

            foreach (\app\models\proxy\CategoryProxy::getAll() as $category) {
                $categoryVeiw = new \app\views\components\category\PublicCategory($category);
                $categoryVeiw->render();
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->