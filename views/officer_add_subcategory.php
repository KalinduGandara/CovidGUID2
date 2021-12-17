<?php

$category_options = [];
foreach ($categories as $category) {
    $category_options[$category['cat_id']] = $category['cat_title'];
}

?>

<style>
    /*body {font-family: Arial, Helvetica, sans-serif;}*/
    /** {box-sizing: border-box;}*/

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        /*border: 3px solid #f1f1f1;*/
        border: 35px solid red;
        /*z-index: 9;*/
        z-index: 3;
        /***/
        background-color: black;
    }

    div form#popupFormContainer {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    div form input#popupTextField, div form input#popupPasswordField {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    b#popupTextFieldLabel, b#popupPasswordFieldLabel {
        color: white;
    }

    div form input#popupTextField:focus, div form input#popupPasswordField:focus {
        background-color: #ddd;
        outline: none;
    }

    div form button#cancelBtn {
        background-color: indianred;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    div form button#verifyBtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    div form button#cancelBtn:hover {
        opacity: 1;
    }
    div form button#verifyBtn:hover {
        opacity: 1;
    }

    div h1#popupHeading {
        color: white;
    }

</style>

<div id="wrapper">

    <?php include "includes/officer_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add a Subcategory
                    </h1>
                </div>
            </div>


            <div class="container">
                <div class="col-xs-6">

                    <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <?php echo $form->selectField($model, 'cat_id', $category_options); ?>
                    <?php echo $form->field($model, 'sub_category_name') ?>
                    <button type="submit" class="btn btn-primary" onclick="openForm()">Submit</button>

                    <div class="form-popup" id="myForm">
                        <form action="" class="form-container" id="popupFormContainer">
                            <h1 id="popupHeading">Verification</h1>

                            <label for="email"><b  id="popupTextFieldLabel">Email</b></label>
                            <input type="text" placeholder="Enter Email" name="email" id="popupTextField" required>

                            <label for="password"><b  id="popupPasswordFieldLabel">Password</b></label>
                            <input type="password" placeholder="Enter Password" name="password" id="popupPasswordField" required>

                            <input type="hidden" id="delete_id" name="delete_id" value="-1">

                            <button type="submit" id="verifyBtn">Verify</button>
                            <!--                            class="btn"-->
                            <button type="button" id="cancelBtn" onclick="closeForm()">Close</button>
                            <!--                            class="btn cancel"-->
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

                </div>

                <div class="col-xs-6">


                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Subcategory name</th>
                                <th>Category</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($subcategories as $row) {
                                $sub_category_id = $row["sub_category_id"];
                                $sub_category_name = $row["sub_category_name"];
                                $cat_id = $row["cat_id"];

                                echo "<tr>
                                            <td>$sub_category_id</td>
                                            <td>$sub_category_name</td>
                                            <td>$category_options[$cat_id]</td>
                            
                                            <td><a href='add-subcategory?delete_id=$sub_category_id'>Delete</a></td>
                                            <td> <button type='button' class='btn btn-secondary' onclick='openForm($sub_category_id)'>Delete2</button> </td>
                                            <td><a href='add-subcategory?edit_id=$sub_category_id'>Edit</a></td>
                                            </tr>";
                            }


                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>