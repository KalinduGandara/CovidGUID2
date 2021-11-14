<?php //include "../includes/db.php" ?>
<?php //include "includes/admin_header.php" ?>
<?php //include "functions.php" ?>
<?php //session_start() ?>

<?php

//if (!isset($_SESSION['password_mismatch']) && !isset($_SESSION['not_admin'])) {
//    header("Location: ../");
//}
//if ($_SESSION['password_mismatch'] == false && $_SESSION['not_admin'] == false) {
//    $username = $_SESSION['username'];
//} else {
//    header("Location: ../");
//}
//if (!\app\core\App::isAdmin()) {
//    header("Location: /");
//}
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
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    All Posts
                </h1>
            </div>
        </div>
        <!-- /.row -->


        <form action="" method="post">
            <div id="bulkOptionsContainer" class="col-xs-4">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select an option</option>
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                    <option value="delete">delete</option>
                </select>
            </div>

            <div class="col-xs-4">
                <button type="submit" name="apply" class="btn btn-success">Apply</button>
                <a href="posts?source=add_post" class="btn btn-primary">Add new post</a>
            </div>


            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th><input type="checkbox" name="selectAll" id="selectAllBox" onclick="selectAllCheckBoxes()"></th>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php
//                foreach ($posts as $post){
//                    foreach ($categories as $category){
//                        if ($post["post_category_id"]==$category["cat_id"]){
////                    $post += array('cat_title'=>$category['cat_title']);
//                            $post['post_category_id'] = $category['cat_title'];
//
//                        }
//                    }
//                }
//                echo '<pre>';
//                var_dump($categories);
//                var_dump($posts);
//                echo '</pre>';
//                exit();
                    foreach ($posts as $row){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

//                    $query2 = "SELECT * FROM categories WHERE cat_id = $post_category_id";
//                    $result2 = mysqli_query($connection, $query2);
//                    confirmQuery($result2);

//                    $row2 = mysqli_fetch_assoc($result2);
//                    $cat_title = $row2['cat_title'];
                        foreach ($categories as $category){
                            if ($row["post_category_id"]==$category["cat_id"]){
                                $cat_title = $category['cat_title'];
                            }
                        }
                    ?>

                    <tr>
                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value=<?php echo $post_id ?>></td>
                        <td><?php echo $post_id ?></td>
                        <td><?php echo $post_author ?></td>
                        <td><a href="/post?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>

                        <td><?php echo $cat_title ?></td>

                        <td><?php echo $post_status ?></td>
                        <td><img width="100" src="../images/<?php echo $post_image ?>" alt="course image is missing"></td>
                        <td><?php echo $post_tags ?></td>
                        <td><?php echo $post_comment_count ?></td>
                        <td><?php echo $post_date ?></td>
                        <td><a href="posts.php?source=edit_post&edit_id=<?php echo $post_id ?>">Edit</a></td>
                        <td><a href="posts.php?del_id=<?php echo $post_id ?>">Delete</a></td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        </form>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!--        --><?php //include "includes/admin_footer.php" ?>

    