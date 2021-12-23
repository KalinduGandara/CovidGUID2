<?php
foreach ($display_guidelines as $guideline) {
    echo "<li>$guideline[guideline] 
                    <a href='/officer/guidelines?edit_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-pencil\"></i></a>
                    <a href='/officer/guidelines?delete_id=$guideline[guid_id]'><i class=\"ms-3 mt-2 fa fa-minus-circle\"></i></a>
                    <button type='button' class='btn btn-secondary' onclick='openForm($guideline[guid_id])'>Delete2</button>
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

<?php $form = \app\core\form\Form::begin('../officer/guidelines', 'post') ?>
    <div class="form-popup" id="myForm">
        <form action="" class="form-container" id="popupFormContainer">
            <h1 id="popupHeading">Verificationnnnnnnnnnnnnn</h1>

            <label for="email"><b  id="popupTextFieldLabel">Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="popupTextField" required>

            <label for="password"><b  id="popupPasswordFieldLabel">Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="popupPasswordField" required>

            <input type="hidden" id="delete_id" name="delete_id" value="-2">

            <button type="submit" id="verifyBtn">Verify</button>
            <!--                            class="btn"-->
            <button type="button" id="cancelBtn" onclick="closeForm()">Close</button>
            <!--                            class="btn cancel"-->
        </form>
    </div>
<?php \app\core\form\Form::end(); ?>


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
