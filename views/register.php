<?php /** @var $model \app\models\User */ ?>

<div class="row container mw-100">
    <div class="col-md-7">
        <div class="container text-white" style="margin-top: 40px">
            <h1>Register</h1>
            <hr>

            <?php $form = \app\core\form\Form::begin('', 'post') ?>

            <?php echo $form->field($model, 'firstname') ?>

            <?php echo $form->field($model, 'lastname') ?>

            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordField() ?>
            <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php $form->end(); ?>
        </div>
    </div>
    <div class="col-md-5 align-self-center text-center d-none d-md-block">
        <img src="/images/register.png" alt="profile" height="400px">
    </div>
</div>


