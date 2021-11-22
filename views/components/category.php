<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $cat_title ?></h3>
    </div>
    <div class="panel-body">
        <?php
        foreach ($category_guidelines as $guideline) {
            echo "* $guideline";
            echo "<br>";
        }
        ?>
    </div>
</div>