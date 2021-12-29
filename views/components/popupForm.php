<?php
?>
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
