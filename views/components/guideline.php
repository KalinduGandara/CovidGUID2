<?php
// template for display guideline
//called via render view
/**
 * params to be passed
 * *id
 * *title
 * *body
 * *status
 * *category
*/
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php $title ?></h3>
    </div>
    <div class="panel-body">
        <?php $body ?>
    </div>
</div>
