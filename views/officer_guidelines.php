
<?php

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/officer_navigation.php" ?>


    <?php
    //                    if (isset($_GET['source'])) {
    //                        $source = $_GET['source'];
    //                    }
    //                    else $source = '';
    //
    //                    switch ($source) {
    //                        case 'add_post':
    //                            include "includes/add_post.php";
    //                            break;
    //
    //                        case 'edit_post':
    //                            include "includes/edit_post.php";
    //                            break;
    //
    //                        default:
    //                            include "includes/view_all_posts.php";
    //                            break;
    //                    }

    ?>
    <div id="page-wrapper" class="container">
        <!-- Page Heading -->
        <h1 class="page-header">
            All Guidelines
        </h1>
        <!-- /.row -->


        <form action="" method="post">
            <div id="bulkOptionsContainer">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select an option</option>
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                    <option value="delete">delete</option>
                </select>
            </div>

            <div>
                <button type="submit" name="apply" class="btn btn-success">Apply</button>
                <a href="/officer/add-guideline" class="btn btn-primary">Add new guideline</a>
            </div>
        </form>
        <hr>
        <?php
            foreach(\app\models\Category::getAll() as $category){
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">


                        <h3 class="panel-title"><?php echo '<h3>'.$category->getCatTitle() .'</h3>' ?>



                    </div>
                    <div class="panel-body">
                    <?php
                        foreach (\app\models\SubCategory::getAllWhere(['cat_id'=> $category->getCatId()]) as $subcategory){
                            echo "<h4>".$subcategory->getSubCategoryName()."</h4>";
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead><tr>
                            <th> Guideline </th>
                            <th> valid from </th>
                            <th> expires on </th>
                            <th> last modified </th>
                            </tr></thead>";
                            foreach(\app\models\Guideline::getAllWhere(['sub_category_id'=>$subcategory->getSubCategoryId()]) as $guideline){
                                $guid = new \app\views\components\guideline\OfficerGuideline($guideline);
                                echo $guid->getRenderString();
                            }
                            echo "</table>";
                        }
                    ?>

                    </div>
                </div>
                <?php
            }

        ?>
    </div>
</div>


