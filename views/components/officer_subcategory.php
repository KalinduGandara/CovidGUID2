<div class="panel panel-default">
    <div class="panel-heading">


        <h3 class="panel-title"><?php echo '<h3>'.$category_name .'</h3><h4>'.$sub_category_name.'</h4>' ?>



    </div>
    <div class="panel-body">
        <?php
        $display_guidelines = $sub_category_guidelines;
        include 'officer_guideline.php'
        ?>

    </div>
</div>
