
<?php /** @var $model \app\models\LoginForm */?>

    <h1>Log in</h1>

<?php $form = \app\core\form\Form::begin('','post') ?>
<?php echo $form->field($model,'email') ?>
<?php echo $form->field($model,'password')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>

<?php \app\core\form\Form::end();?>