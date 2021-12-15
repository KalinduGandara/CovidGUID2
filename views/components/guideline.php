<?php
// template for display guideline
if (\app\core\App::isGuest()) { //guest view
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $guideline['cat_title'] . ' > ' . $guideline['guid_title'] ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $guideline['guidline'] ?>
        </div>
    </div>
<?php
} elseif (\app\core\App::isOfficer()) {   //officer view;
?>
    <div class="card">
        <h5 class="card-header"><?php echo $guideline['cat_title'] ?></h5>
        <div class="card-body">
            <h5 class="card-title"><?php echo $guideline['sub_category_name'] ?></h5>
            <p class="card-text"><?php echo $guideline['guideline'] ?></p>
            <a href="/officer/guidelines?edit_id=<?= $guideline['guid_id'] ?>" class="btn btn-primary">Edit</a>
            <a href="/officer/guidelines?delete_id=<?= $guideline['guid_id'] ?>" class="btn btn-danger">Delete</a>
        </div>
    </div>
<?php
}
?>
