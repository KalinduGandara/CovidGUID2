<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/officer_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <style>
                    body {font-family: Arial, Helvetica, sans-serif;}
                    * {box-sizing: border-box;}

                    /* Button used to open the contact form - fixed at the bottom of the page */
                    .open-button {
                        background-color: #555;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        opacity: 0.8;
                        position: fixed;
                        bottom: 23px;
                        right: 28px;
                        width: 280px;
                    }

                    /* The popup form - hidden by default */
                    .form-popup {
                        display: none;
                        position: fixed;
                        bottom: 0;
                        right: 15px;
                        border: 3px solid #f1f1f1;
                        z-index: 9;
                    }

                    /* Add styles to the form container */
                    .form-container {
                        max-width: 300px;
                        padding: 10px;
                        background-color: white;
                    }

                    /* Full-width input fields */
                    .form-container input[type=text], .form-container input[type=password] {
                        width: 100%;
                        padding: 15px;
                        margin: 5px 0 22px 0;
                        border: none;
                        background: #f1f1f1;
                    }

                    /* When the inputs get focus, do something */
                    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                        background-color: #ddd;
                        outline: none;
                    }

                    /* Set a style for the submit/login button */
                    .form-container .btn {
                        background-color: #04AA6D;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                        margin-bottom:10px;
                        opacity: 0.8;
                    }

                    /* Add a red background color to the cancel button */
                    .form-container .cancel {
                        background-color: red;
                    }

                    /* Add some hover effects to buttons */
                    .form-container .btn:hover, .open-button:hover {
                        opacity: 1;
                    }
                </style>

                <div class="container">
                    <div class="col-xs-6">


                        <!--                    <form action="" method="post">-->
                        <!--                        <div class="form-group">-->
                        <!--                            <label for="cat_title" class="form-label">Category name</label>-->
                        <!--                            <input type="text" class="form-control" name="cat_title" id="cat_title">-->
                        <!--                        </div>-->
                        <!--                        <div class="form-group">-->
                        <!--                            <input type="submit" class="btn btn-primary" value="Add category" name="submit">-->
                        <!--                        </div>-->
                        <!--                    </form>-->

                        <?php $form = \app\core\form\Form::begin('', 'post') ?>
                        <?php echo $form->field($model, 'cat_title') ?>
                        <?php echo $form->textareaField($model, 'category_description') ?>
                        <button type="submit" class="btn btn-primary" onclick="openForm()">Submit</button>

                        <div class="form-popup" id="myForm">
                            <form action="" class="form-container">
                                <h1>Login</h1>

                                <label for="email"><b>Email</b></label>
                                <input type="text" placeholder="Enter Email" name="email" required>

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>

                                <input type="hidden" id="delete_id" name="delete_id" value="-1">

                                <button type="submit" class="btn">Login</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                        </div>

                        <script>
                            function openForm(delete_id = null) {
                                document.getElementById("myForm").style.display = "block";
                                if(delete_id !== null)
                                {
                                    document.getElementById("delete_id").value = delete_id;
                                }
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }
                        </script>

                        <?php \app\core\form\Form::end(); ?>
                        <!--                    --><?php //if ($mode == 'update') {
                        ?>
                        <!---->
                        <!--                    --><?php //$form = \app\core\form\Form::begin('','post')
                        ?>
                        <!--                    --><?php //echo $form->field($model,'cat_title')
                        ?>
                        <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
                        <!---->
                        <!--                    --><?php //\app\core\form\Form::end();
                        ?>
                        <!--                    --><?php //}
                        ?>


                    </div>

                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category name</th>
                                <th>Category description</th>
                            </tr>
                            </thead>
                            <tbody>

                            <!-- query to get categories from database -->
                            <!--                                -->
                            <?php //get_all_categories();
                            //                                while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($categories as $category) {
                                $cat_id = $category->getCatId();
                                $cat_title = $category->getCatTitle();
                                $category_description = $category->getCategoryDescription();
                                echo "<tr>
                                            <td>$cat_id</td>
                                            <td>$cat_title</td>
                                            <td>$category_description</td>
                                            <td><a href='categories?delete_id=$cat_id'>Delete</a></td>
                                            <td> <button type='button' class='btn btn-secondary' onclick='openForm($cat_id)'>Delete2</button> </td>
                                            <td><a href='categories?edit_id=$cat_id'>Edit</a></td>
                                            </tr>";
                            }


                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
