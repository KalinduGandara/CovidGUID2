<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?php echo $category->getCatTitle(); ?>

            </h1>

            <!-- Display Categories -->

            <?php
            //            echo '<pre>';
            //            var_dump($categories);
            //            var_dump($guidelines);
            //
            //            echo '</pre>';
            //            exit();

            foreach ($subcategories as $subcategory) {
                $cat_id = $category->getCatId();
                if ($subcategory->getCatId() === $cat_id) {

                    $sub_category_name = $subcategory->getSubCategoryName();
                    //                    $cat_status = $category['cat_status'];

                    $sub_category_id = $subcategory->getSubCategoryId();
                    $sub_category_guidelines = [];
                    foreach ($guidelines as $guideline) {
                        if ($guideline->getSubCategoryId() == $sub_category_id) {
                            array_push($sub_category_guidelines, $guideline);
                        }
                    }
                    include "components/subcategory.php";
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->