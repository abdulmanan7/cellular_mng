<?php if (null!==$this->session->flashdata('message')) {
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
} ?>
<?php
if(!empty($message))
{
    echo '<div class="alert alert-success">'.$message.'</div>';
}
?>
<div class="box box-primary">
    <?php if (empty($statuslist)): ?>
        <p>No Record Added Yet.</p>
    <?php else: ?>
    <div class="box-body">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>	<?php echo lang('status_view_name_label'); ?>			</th>
                <th>	<?php echo lang('status_view_is_default_label');?>	</th>
                <th>	<?php echo lang('status_view_is_enable_label');?>	</th>
                <th>	<?php echo lang('status_view_action'); ?>				</th>

            </tr>
            </thead>
            <?php foreach($statuslist as $val) :?>
                <tbody>
                <tr>
                    <td><?php echo $val['name'] ;?></td>
                    <td><?php echo ($val['is_default']=='1'? '<span class="label label-info">'.lang('status_view_yes_label').'</span>':lang('status_view_no_label'));?></td>
                    <td><?php echo ($val['is_enable']=='1'? lang('status_view_yes_label'):'<span class="label label-default">'.lang('status_view_no_label')).'</span>';?></td>
                    <td>
                        <a href="<?php echo site_url('invoice/save_invoice_status')."/".$val['id']; ?>" class="btn btn-xs btn-info">
                            <i class="glyphicon glyphicon-edit glyphicon-white" ></i>
                        </a>
                        <a href="<?php echo site_url('invoice/delete_invoice_status')."/".$val['id']; ?>" class="delete btn btn-xs btn-danger">
                            <i class="glyphicon glyphicon-trash glyphicon-white" ></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            <?php endforeach ?>
        </table>
        <nav class="pull-right">
            <?php echo $links ?>
        </nav>
        <?php endif ?>
    </div>
</div>