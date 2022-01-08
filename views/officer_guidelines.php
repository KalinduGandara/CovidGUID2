
<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col" style="margin-left: 250px">
            <div id="page-wrapper" class="container" style="border-radius: 5px">
                <!-- Page Heading -->
                <h1 class="page-header">
                    All Guidelines
                </h1>
                <hr>
                <div class="container">
                    <h5>Guideline status are indicated with following colors</h5>
                    <table class="table">
                        <tr>
                            <td >Created</td>
                            <td class="table-secondary">Active</td>
                            <td class="table-info">Drafted</td>
                            <td class="table-warning">Expired</td>
                        </tr>
                    </table>
                </div>
            </div>
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
                <div class="card card-default bg-white m-2">
                    <div class="card-header">


                        <h3 class="card-title"><?php echo '<h3>'.$category->getCatTitle() .'</h3>' ?>



                    </div>
                    <div class="card-body">
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
</div>


