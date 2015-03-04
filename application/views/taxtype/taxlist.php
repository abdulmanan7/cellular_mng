<?php if (null!==$this->session->flashdata('message')) {
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
} ?>
<?php if (!empty($message)): ?>
    <div class="alert alert-info alert-dismissable">
        <i class="fa fa-info"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Note:</b> <?php echo $message;?>
    </div>
<?php endif ?>
<div class="panel panel">

    <?php if (empty($taxlist)): ?>
        <p class="no-data">No Record Added Yet.</p>
    <?php else: ?>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>	<?php echo lang('view_name_label'); ?>			</th>
                    <th>	<?php echo lang('view_percentage_label');?>	</th>
                    <th>	<?php echo lang('view_action'); ?>				</th>
                </tr>
                </thead>
                <?php foreach($taxlist as $val) :?>
                    <tbody>
                    <tr>
                        <td><?php echo $val['name'] ;?></td>
                        <td><?php echo $val['percentage'];?></td>
                        <td>
                            <a href="<?php echo site_url('taxtype/update')."/".$val['id']; ?>" class="btn btn-xs btn-info" data-original-title="Update">
                                <i class="glyphicon glyphicon-edit glyphicon-white" ></i>
                            </a>
                            <a href="<?php echo site_url('taxtype/delete')."/".$val['id']; ?>" class="delete btn btn-xs btn-danger" data-original-title="Delete">
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
        </div>
    <?php endif ?>
</div>