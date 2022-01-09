<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center text-white">
<form action="/admin/verify" method="post">
    <?php if ($fail) {?>
    <h6 class="text-danger">Wrong Password</h6>
    <?php }?>

    <label for="verify">Enter Password</label>
    <input type="password" name="verify" class="form-control">
    <br/>
    <a type="button" class="btn btn-secondary" href="/admin/cancel-verify">Cancel</a>
<!--    <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>-->
    <button type="submit" class="btn btn-danger">Verify</button>

</form>
</div>
