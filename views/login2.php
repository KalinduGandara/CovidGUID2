<?php /** @var $model \app\models\LoginForm */ ?>
<div class="row mw-100 m-5" style="margin-top: 40px">
    <div class="container col-md-5 text-center  d-none d-md-block">
        <img src="/images/login.png" alt="login" width="400px">
    </div>
    <div class="container col-md-7 text-white text-center">
        <div class="container">
            <h1>Log in</h1>
            <hr>
            <div class="container" style="margin-top: 40px">
                <?php $form = \app\core\form\Form::begin('', 'post') ?>
                <div style="margin: 15px">
                    <?php echo $form->field($model, 'email') ?>
                </div>
                <div style="margin: 15px">
                    <?php echo $form->field($model, 'password')->passwordField() ?>

                </div>

                <div style="margin: 15px">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>

            </div>

            <?php $form->end(); ?>
        </div>


    </div>
</div>

