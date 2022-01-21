<div class="container-fluid">
    <div class="row flex-nowrap">
        <?php include "includes/admin_navigation.php" ?>
        <div class="col py-3 bg-white" style="margin-left: 250px">
            <?php if ($mode == 'show'){ ?>
            <h1>Manage Users </h1>
            <?php
            $form = \app\core\form\Form::begin('', 'get');
            $filter1 =  $form->selectField(null, 'qstatus', [
                '0' => 'Inactive',
                '1' => 'Active',
                '2' => 'Deleted',
            ]);
            $selectStatus = false;
            $selectType = false;
            if(isset($_GET['qstatus'])){
                $filter1->select($_GET['qstatus']);
                $selectStatus = true;
            }
            $filter2 =  $form->selectField(null, 'qtype', [
                '1' => 'Officer',
                '2' => 'Public User',
            ]);
            if(isset($_GET['qtype'])){
                $filter2->select($_GET['qtype']);
                $selectType = true;
            }
            ?>
            <div class="row">
                <div class="col">
                    <label>Select Status</label>
                    <?php echo $filter1; ?>
                </div>
                <div class="col">
                    <label>Select Role</label>
                    <?php echo $filter2; ?>
                </div>
            </div>
            <div>
                <?php if(((isset($_GET['qstatus'])) || (isset($_GET['qtype'])))){?>
                    <a href="/admin/users" class="btn btn-secondary">Clear filters</a>
                <?php } ?>

                <a href="/admin/users?source=add_user" class="btn btn-primary">Add New User</a>
            </div>
            <?php
            $form::end();
            ?>
            <hr>

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
                    if ($selectType && $selectStatus)
                        $users = \app\models\User::getAllWhere(['status'=>$_GET['qstatus'],'type'=>$_GET['qtype']]);
                    elseif ($selectType)
                        $users = \app\models\User::getAllWhere(['type'=>$_GET['qtype']]);
                    elseif ($selectStatus)
                        $users = \app\models\User::getAllWhere(['status'=>$_GET['qstatus']]);
                    else
                        $users = \app\models\User::getAll();
                    foreach ($users as $user) {
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
                        <?php echo $form->selectField($model, 'type', [1 => 'Officer', 2 => 'Public User'],false,$model->type) ?>
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
            <script>
                $(document).ready(()=>{
                    $('select[name="qstatus"]').change(()=>{
                        if ($('select[name="qtype"]').val() != undefined)
                            window.location.href = "/admin/users?qstatus="+$('select[name="qstatus"]').val()+"&qtype="+$('select[name="qtype"]').val();
                        else
                            window.location.href = "/admin/users?qstatus="+$('select[name="qstatus"]').val();

                    });

                    $('select[name="qtype"]').change(()=>{
                        if ($('select[name="qstatus"]').val() != undefined)
                            window.location.href = "/admin/users?qstatus="+$('select[name="qstatus"]').val()+"&qtype="+$('select[name="qtype"]').val();
                        else
                            window.location.href = "/admin/users?qtype="+$('select[name="qtype"]').val();
                    });

                });



            </script>
        </div>
    </div>
</div>
