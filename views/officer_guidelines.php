
<?php
    new \app\views\components\category\CategoryBuilder(new \app\models\Category());
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


        <?php
            $form = \app\core\form\Form::begin('', 'get');
            $filter =  $form->selectField(null, 'status', [
               '0' => 'Created',
               '1' => 'Active',
               '2' => 'Drafted',
               '3' => 'Expired',
                '4'=> 'Deleted'
            ]);
            if(isset($_GET['status'])){
                $filter->select($_GET['status']);
            }
            echo $filter;
        ?>

            <div>
                <?php if(!isset($_GET['status'])){?>
                <button type="submit" class="btn btn-success">Apply</button>
                <?php }
                else {?>
                <a href="/officer/guidelines" class="btn btn-secondary">Clear filters</a>
                <?php }?>
                <a href="/officer/add-guideline" class="btn btn-primary">Add new guideline</a>
            </div>
        <?php
            $form::end();
        ?>
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
                            $subcategoryView = \app\views\components\subcategory\SubcategoryBuilder::buildOfficerVeiw($subcategory->getSubCategoryId());
                            if(isset($_GET['status'])){
                                $subcategoryView->filterByStatus($_GET['status']);
                            }
                            else{
                                $subcategoryView->filterOutDeleted();
                            }
                            $subcategoryView->includeTitle()->render();
                        }
                    ?>

                    </div>
                </div>
                <?php
            }

        ?>
    </div>
</div>


