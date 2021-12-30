<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
<!--                --><?php //echo $category->cat_title; ?>
            Search Result of <?php echo $_GET['search']?>
            </h1>

            <!-- Display Categories -->

            <?php

            foreach ($subcategories as $subcategory) {
                $subcategoryView = \app\views\components\subcategory\SubcategoryBuilder::buildPublicVeiw($subcategory->getSubCategoryId());
                $subcategoryView->includeTitle()->render();
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->