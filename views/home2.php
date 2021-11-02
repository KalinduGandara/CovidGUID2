<?php //include "layouts/db.php" ?>
<?php //include "layouts/header.php" ?>

    <!-- Navigation  *** Note: session_start() method is in this--> 


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Posts -->

                <?php

                foreach ($posts as $post){

                $post_id = $post['post_id'];
                $post_title = $post['post_title'];
                $post_author = $post['post_author'];
                $post_date = $post['post_date'];
                $post_image = $post['post_image'];
                $post_content = substr($post['post_content'],0,200)."...";
                $post_last_edited = $post['post_last_edited'];

                ?>


                                    <h2>
                                        <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                                    </h2>
                                    <p class="lead">
                                        by <a href="index.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?>
                                    <?php
                                        if (!empty($post_last_edited)) {
                                            echo ", Last edited on $post_last_edited";
                                        }
                                    ?>
                                    </p>
                                    <hr>
                                    <a href="post.php?post_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt="post image is missing"></a>
                                    <hr>
                                    <p><?php echo $post_content ?></p>
                                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                    <hr>

                            <?php
                            }
                    ?>
                            

                <!-- //Pager
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                
<!--            --><?php //if ($posts_count) :
//                for ($i=1; $i <= $num_of_pages; $i++) :
//
//                    if ($i == $current_page) :?>
<!--                         <li class="page-item"><a  style="background-color: #000080;" class="page-link" href="index.php?page=--><?php //echo $i;?><!--">--><?php //echo $i;?><!--</a></li>  -->
<!--                         -->
<!--                     --><?php //continue;
//                        endif ?>
<!---->
<!--                    <li class="page-item"><a class="page-link" href="index.php?page=--><?php //echo $i;?><!--">--><?php //echo $i;?><!--</a></li>  -->
<!---->
<!--            --><?php //endfor ?><!--             -->
<!--            --><?php //endif ?>
                
            </ul>
        </nav>
        <!-- Footer -->
<!--        --><?php //include "layouts/footer.php" ?>

    
