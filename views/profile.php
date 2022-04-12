<?php ?>
<?php
///** @var $this \app\core\View */

$this->title = "Profile"
?>
<div class="row mw-100 mh-100">
    <div class=" col-md-5 text-center align-self-center d-none d-md-block">
        <img src="/images/profile.png" alt="profile" height="400px">
    </div>
    <div class="col-md-7" >
        <div class="container text-white" style="margin-top: 40px">
            <?php echo "<h1>$model->firstname $model->lastname</h1>" ?>
            <?php $form = \app\core\form\Form::begin('', 'post') ?>

            <?php echo $form->field($model, 'firstname') ?>

            <?php echo $form->field($model, 'lastname') ?>

            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordField() ?>
            <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <?php \app\core\form\Form::end(); ?>
        </div>
    </div>

</div>

