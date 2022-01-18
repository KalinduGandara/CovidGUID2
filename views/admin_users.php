<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/admin_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <?php if ($mode == 'show'){ ?>

            <div class="container-fluid">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach (\app\models\User::getAll() as $user) {
                        $user_view = new \app\views\components\user\User($user);
                        $user_view->render();
                    }
                        ?>

                    </tbody>
                </table>
                <?php } elseif ($mode == 'create') { ?>
                    <div class="container">
                        <h1>Add User</h1>

                        <?php $form = \app\core\form\Form::begin('', 'post') ?>

                        <?php echo $form->field($model, 'firstname') ?>

                        <?php echo $form->field($model, 'lastname') ?>

                        <?php echo $form->field($model, 'email') ?>
                        <?php echo $form->selectField($model, 'type', [1 => 'Officer', 2 => 'Public User']) ?>
                        <?php echo $form->field($model, 'password')->passwordField() ?>
                        <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?php $form->end(); ?>

                    </div>
                <?php } elseif ($mode == 'edit') { ?>
                    <div class="container">
                        <h1>Update User</h1>

                        <?php $form = \app\core\form\Form::begin('', 'post') ?>

                        <?php echo $form->field($model, 'firstname') ?>

                        <?php echo $form->field($model, 'lastname') ?>
                        <?php echo $form->selectField($model, 'type', [1 => 'Officer', 2 => 'Public User'],false,$model->type) ?>
                        <?php echo $form->field($model, 'password')->passwordField() ?>
                        <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?php $form->end(); ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
