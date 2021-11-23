<div class="panel panel-default">
    <div class="panel-heading">


        <h3 class="panel-title"><?php echo '<h3>'.$category_name .'</h3><h4>'.$sub_category_name.'</h4>' ?>



    </div>
    <div class="panel-body">
        <?php
        foreach ($sub_category_guidelines as $guideline) {
            echo "<li>$guideline[guid_body] 
                    <a href='/officer/guidelines?edit_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-pencil\"></i></a>
                    <a href='/officer/guidelines?delete_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-minus-circle\"></i></a>
                   </li>";
        }

        ?>

    </div>
</div>
