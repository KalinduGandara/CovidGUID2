<?php ?>
<?php
///** @var $this \app\core\View */

$this->title = "Profile"
?>

<div class="container" style="margin-top: 40px">
    <?php echo "<h1>$model->firstname $model->lastname</h1>" ?>
    <?php $form = \app\core\form\Form::begin('', 'post') ?>

    <?php echo $form->field($model, 'firstname') ?>

    <?php echo $form->field($model, 'lastname') ?>

    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Update</button>
</div>
<?php \app\core\form\Form::end(); ?>