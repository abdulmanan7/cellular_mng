   <section class="custom-page">
	<div class="col-xs-12">
		<h2 class="page-header">
    <i class="glyphicon glyphicon-log-in" aria-hidden="true"></i> <?php echo lang('index_list_users');?>

        <span class="pull-right" id="userbtn"><?php echo anchor('auth/create_user', 'Add User', 'class="btn btn-primary btn-xs"') ?> </span>
		</h2>
	</div>
	<!-- /.col -->
	<div class="showback">
<div class="panel panel">
    <div class="panel-body">
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
                        <i class="glyphicon glyphicon-pencil glyphicon-white" ></i> <?php echo lang('index_edit_th') ?></a>
                    <a href="auth/delete_user/<?php echo $user->id;?>" class="delete btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-remove glyphicon-white" ></i> <?php echo lang('index_delete_th') ?></a>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <nav class="pull-right">
            <?php echo $links ?>
        </nav>
    </div>
</div>
</div>
</section>