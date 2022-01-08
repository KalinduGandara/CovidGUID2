<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
<!--                -->
                <?php
                use app\models\SubCategory;
                use app\views\components\subcategory\SubcategoryBuilder;
                ?>
            Search Result of <?php echo $_GET['search']?>
            </h1>

            <!-- Display Categories -->

            <?php

            foreach (SubCategory::searchBy(["sub_category_name" => $_GET['search']]) as $subcategory) {
                $subcategoryView = SubcategoryBuilder::buildPublicVeiw($subcategory->getSubCategoryId());
                $subcategoryView->includeTitle()->render();
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->