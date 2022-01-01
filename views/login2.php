<?php /** @var $model \app\models\LoginForm */ ?>

<div class="container" style="margin-top: 40px">
    <h1>Log in</h1>
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
