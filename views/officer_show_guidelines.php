<?php

?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/officer_navigation.php" ?>

    <div id="page-wrapper" class="container">
        <!-- Page Heading -->
        <h1 class="page-header">
            <?php
                echo 'Available Guidelines';
                if(isset($guideline))
                {
                    $model = $guideline;
                }
                else //only having cat_id and sub_category_id. Not the guideline
                {
                    $model = \app\models\Guideline::findOne(['cat_id' => $category->cat_id, 'sub_category_id' => $subcategory->sub_category_id]);
                }

            ?>
        </h1>
        <!-- /.row -->
        <div class="container">
            <?php
            $category_options = [];
            foreach ($categories as $category) {
                $category_options[$category['cat_id']] = $category['cat_title'];
            }
            $subcategory_options = [];
            foreach ($subcategories as $subcategory) {
                if(isset($_GET['cat_id'])){
                    if($subcategory['cat_id'] === $_GET['cat_id'])
                        $subcategory_options[$subcategory['sub_category_id']] = $subcategory['sub_category_name'];
                }
                else{
                    $subcategory_options[$subcategory['sub_category_id']] = $subcategory['sub_category_name'];
                }
            }
                echo '<div class="container mb-3 pb-5" style="background-color: #f4f4f4">';
                $display_guidelines = array_filter($display_guidelines, function ($guideline) use($model){
                                return $guideline['cat_id'] === $model->cat_id && $guideline['sub_category_id'] === $model->sub_category_id;
                            });
                include 'components/officer_guideline.php';
                echo '</div>';
            ?>
        </div>
    </div>
</div>
