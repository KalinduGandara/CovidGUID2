<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?php echo $category->cat_title; ?>

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
                $cat_id = $category->cat_id;
                if ($subcategory['category_id'] === $cat_id) {

                    $sub_category_name = $subcategory['sub_category_name'];
                    //                    $cat_status = $category['cat_status'];

                    $sub_category_id = $subcategory['sub_category_id'];
                    $sub_category_guidelines = [];
                    foreach ($guidelines as $guideline) {
                        if ($guideline['sub_category_id'] == $sub_category_id) {
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