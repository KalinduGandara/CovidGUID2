<div class="panel panel-default">
    <div class="panel-heading">


        <h3 class="panel-title"><?php echo $sub_category_name ?></h3>



    </div>
    <div class="panel-body">
        <?php
        foreach ($sub_category_guidelines as $guideline) {
            echo "<li>$guideline[guideline]</li>";
        }

        ?>

    </div>
</div>