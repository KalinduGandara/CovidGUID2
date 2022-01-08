<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <?php if ($mode == 'show'){ ?>
        <div class="container-fluid">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($users as $user) {
                    $user_id = $user->getId();
                    $user_firstname = $user->getFirstname();
                    $user_lastname = $user->getLastname();
                    $user_email = $user->getEmail();
                    $user_status = $user->getStatus();
                    $user_role = $user->getType();
                    ?>

                    <tr>
                        <td><?php echo $user_id ?></td>
                        <td><?php echo $user_firstname ?></td>
                        <td><?php echo $user_lastname ?></td>
                        <td><?php echo $user_email ?></td>
                        <td><?php if ($user_role == 2)
                                echo 'Public User';
                            elseif ($user_role == 0)
                                echo "Admin";
                            elseif ($user_role == 1)
                                echo "Officer" ?></td>
                        <td><?php if ($user_status == 0)
                                echo "Inactive";
                            elseif ($user_status == 1)
                                echo "Active";
                            elseif ($user_status == 2)
                                echo "Deleted" ?></td>
                        <td><a href="users?source=change_status&user_id=<?php echo $user_id ?>"><?php  if ($user_status == 0)
                                                                                                            echo 'Active';
                                                                                                        elseif ($user_status == 1)
                                                                                                            echo 'Inactive'; ?></a></td>
                        <td><a href="users?source=edit_user&edit_user_id=<?php echo $user_id ?>">Edit</a></td>
                        <?php if ($user_status !=2){ ?>
                        <td><a href="users?del_id=<?php echo $user_id ?>"
                               onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                        <?php } ?>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
            <?php } elseif ($mode == 'create') { ?>
                <div class="container">
                    <h1>Add User</h1>

                    <?php $form = \app\core\form\Form::begin('','post') ?>

                    <?php echo $form->field($model,'firstname') ?>

                    <?php echo $form->field($model,'lastname') ?>

                    <?php echo $form->field($model,'email') ?>
<!--                    --><?php //echo $form->selectField($model,'type') ?>
<!--                    <div class="mb-3">-->
<!--                    <lable><b>Type</b></lable>-->
<!--                    <select required name="type" id="type" class="form-control">-->
<!--                        <option value="1">Officer</option>-->
<!--                        <option value="2">Public User</option>-->
<!--                    </select>-->
<!--                    </div>-->
                    <?php echo $form->selectField($model,'type',[1=>'Officer',2=>'Public User'])?>
                    <?php echo $form->field($model,'password')->passwordField() ?>
                    <?php echo $form->field($model,'confirmPassword')->passwordField() ?>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <?php $form->end();?>

                </div>
            <?php } elseif ($mode == 'edit') { ?>
            <div class="container">
                <h1>Update User</h1>

                <?php $form = \app\core\form\Form::begin('','post') ?>

                <?php echo $form->field($model,'firstname') ?>

                <?php echo $form->field($model,'lastname') ?>
                <?php echo $form->selectField($model,'type',[1=>'Officer',2=>'Public User'])?>
                <?php echo $form->field($model,'password')->passwordField() ?>
                <?php echo $form->field($model,'confirmPassword')->passwordField() ?>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php $form->end();?>
            </div>
            <?php } ?>

        </div>

    </div>


