<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                New Normal Guidelines
            </h1>
            <?php

            use app\core\App;
            use app\models\proxy\CategoryProxy;
            use app\models\User;
            use app\views\components\category\PublicCategory;
            if (!App::isGuest() && App::$app->getUser()->isSubscribed())
                echo '<a style="margin-top: -40px" class="btn btn-warning float-end" href="unsubscribe">UnSubscribe All</a>';
            else
                echo '<a style="margin-top: -40px" class="btn btn-danger float-end" href="subscribe">Subscribe All</a>';

            ?>
            <hr>

            <!-- Display Categories -->


            <?php
            $subscribeList = App::isGuest() ? []: App::$app->getUser()->getSubscribeList();
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