<?php
foreach ($display_guidelines as $guideline) {
    echo "<li>$guideline[guideline] 
                    <a href='/officer/guidelines?edit_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-pencil\"></i></a>
                    <a href='/officer/guidelines?delete_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-minus-circle\"></i></a>
                    <button type='button' class='btn btn-secondary' onclick='openForm1($guideline[guid_id])'>Delete2</button>
                   </li>";
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

    div form#popupFormContainer1 {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    div form input#popupTextField1, div form input#popupPasswordField1 {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    b#popupTextFieldLabel1, b#popupPasswordFieldLabel1 {
        color: white;
    }

    div form input#popupTextField1:focus, div form input#popupPasswordField1:focus {
        background-color: #ddd;
        outline: none;
    }

    div form button#cancelBtn1 {
        background-color: indianred;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    div form button#verifyBtn1 {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    div form button#cancelBtn1:hover {
        opacity: 1;
    }
    div form button#verifyBtn1:hover {
        opacity: 1;
    }

    div h1#popupHeading1 {
        color: white;
    }
</style>

<?php
if(!(isset($_GET['cat_id']) || isset($_GET['edit_id'])))
{
    $form1 = \app\core\form\Form::begin('../officer/guidelines', 'post') ?>
    <div class="form-popup" id="myForm1">
        <form action="" class="form-container" id="popupFormContainer1">
            <h1 id="popupHeading1">Verification</h1>

            <label for="email"><b  id="popupTextFieldLabel1">Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="popupTextField1" required>

            <label for="password"><b  id="popupPasswordFieldLabel1">Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="popupPasswordField1" required>

            <input type="hidden" id="delete_id1" name="delete_id1" value="-2">

            <button type="submit" id="verifyBtn1">Verify</button>
            <button type="button" id="cancelBtn1" onclick="closeForm1()">Close</button>
        </form>
    </div>

    <script>
        function openForm1(delete_id = null) {
            document.getElementById("myForm1").style.display = "block";
            if(delete_id !== null)
            {
                document.getElementById("delete_id1").value = delete_id;
            }
        }

        function closeForm1() {
            document.getElementById("myForm1").style.display = "none";
        }
    </script>

<?php
}
\app\core\form\Form::end(); ?>



