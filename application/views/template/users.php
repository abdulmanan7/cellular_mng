<div class="col-sm-10">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel bootstrap-admin-no-table-panel">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span><p><?php echo lang('index_list_users');?></p>

                        <p class="text-right"
                           id="userbtn"><?php echo anchor('auth/create_user', 'Add User', 'class="btn btn-primary btn-xs"') ?>
                        </p>
                    </div>
                </div>
                <div class="bootstrap-admin-panel-content">
                    <div id="infoMessage"><?php echo $message;?></div>
                    <table class="table bootstrap-admin-table-with-actions">
                        <thead>
                        <tr>
                            <th><?php echo lang('index_fname_th');?></th>
                            <th><?php echo lang('index_lname_th');?></th>
                            <th><?php echo lang('index_email_th');?></th>
                            <th><?php echo lang('index_action_th');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php foreach ($users as $user):?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                            <td><a href="auth/edit_user/<?php echo $user->id;?>" class="btn btn-xs btn-success">
                                    <i class="glyphicon glyphicon-pencil glyphicon-white" ></i><?php echo lang('index_edit_th') ?></a>
                                <a href="auth/change_password/<?php echo $user->id;?>" class="btn btn-xs btn-info">
                                    <i class="glyphicon glyphicon-edit glyphicon-white" ></i><?php echo lang('index_change_password_th') ?></a>
                                <a href="auth/delete_user/<?php echo $user->id;?>" class="delete btn btn-xs btn-danger">
                                    <i class="glyphicon glyphicon-remove glyphicon-white" ></i><?php echo lang('index_delete_th') ?></a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tr>
                        </tbody>
                    </table>
                    <nav class="pull-right">
                        <?php echo $links ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>