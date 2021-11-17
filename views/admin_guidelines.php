
<?php

if (!\app\core\App::isAdmin()) {
    header("Location: /");
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>


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
                <a href="posts?source=add_post" class="btn btn-primary">Add new guideline</a>
            </div>
        </form>
            <hr>
            <?php
                var_dump($guidelines);
            ?>
        </div>
    </div>


