<?php /** @var $model \app\models\User */?>

<div class="container">
    <h1>Register</h1>

    <?php $form = \app\core\form\Form::begin('','post') ?>

            <?php echo $form->field($model,'firstname') ?>

            <?php echo $form->field($model,'lastname') ?>

    <?php echo $form->field($model,'email') ?>
    <?php echo $form->field($model,'password')->passwordField() ?>
    <?php echo $form->field($model,'confirmPassword')->passwordField() ?>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php \app\core\form\Form::end();?>

