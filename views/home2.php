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

            use app\models\proxy\CategoryProxy;
            use app\models\User;
            use app\views\components\category\PublicCategory;

            $subscribeList = User::getSubscribeList();
            foreach (CategoryProxy::getAll() as $category) {
                $categoryView = new PublicCategory($category);
                if (in_array($category->getCatId() , $subscribeList)) {
                    $categoryView->setIsSubscribed(true);
                }
                $categoryView->render();
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->