<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <form action="">
            <div class="input-group">
                <input required name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" >
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>

    <!-- Login Well -->
    <!--    <div class="well">-->
    <!--        <h4>Login</h4>-->
    <!--        <form action="includes/login.php" method="post">-->
    <!--        <div class="form-group"> -->
    <!--              -->
    <!--            <input name="username" type="text" class="form-control" placeholder="username">        -->
    <!--        </div>-->
    <!--        <div class="input-group">-->
    <!--            <input name="user_password" type="password" class="form-control" placeholder="password">-->
    <!--            <span class="input-group-btn">-->
    <!--                <button type="submit" class="btn btn-primary" name="login">Login</button>-->
    <!--            </span>-->
    <!--        </div>-->
    <!--        <br>-->
    <!--        -->
    <!--            <p style="color: red;"> -->
    <!--                --><?php //
                            //                if (isset($_SESSION['not_admin'])) {
                            //                    if($_SESSION['not_admin'] == true)
                            //                    {
                            //                        echo " You do not have admin privileges";
                            //                    }
                            //                }
                            //                
                            ?>
    <!--            </p>-->
    <!--            <p style="color: red;"> -->
    <!--                --><?php //
                            //                if (isset($_SESSION['not_admin'])) {
                            //                    if ($_SESSION['password_mismatch'] == true)
                            //                    {
                            //                        echo " username and password do not match";
                            //                    }
                            //                }
                            //
                            //                
                            ?>
    <!--            </p>-->
    <!--        -->
    <!--        </form>-->

    <!--        --><?php //$form = \app\core\form\Form::begin('/login','post') 
                    ?>
    <!--        --><?php //echo $form->field($model,'email') 
                    ?>
    <!--        --><?php //echo $form->field($model,'password')->passwordField() 
                    ?>
    <!--        <button type="submit" class="btn btn-primary">Submit</button>-->
    <!---->
    <!--        --><?php //\app\core\form\Form::end();
                    ?>

    <!-- /.input-group -->
    <!--    </div>-->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                    foreach ($categories as $category) {
                        $cat_id = $category['cat_id'];
                        $cat_title = $category['cat_title'];
                        echo "<li><a href='\?cat_id=$cat_id'>$cat_title</a></li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "sideWidget.php"; ?>

</div>