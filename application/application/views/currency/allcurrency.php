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
    <?php if (empty($allcurrency)): ?>
        <p>No Record Added Yet.</p>
    <?php else: ?>
    <div class="box-body">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>	<?php echo lang('view_title_label'); ?>			</th>
                <th>	<?php echo lang('view_code_label');?>	</th>
                <th>	<?php echo lang('view_value_label'); ?>			</th>
                <th>	<?php echo lang('view_date_modified_label'); ?>			</th>
                <th>	<?php echo lang('view_action'); ?>				</th>

            </tr>
            </thead><!-- Table heading -->
            <?php foreach($allcurrency as $val) :?>
                <tbody>
                <tr <?php if($val['status']=='0') echo 'class=warning';?>>
                    <td><?php echo $val['title'];if($val['default']=='1') echo ' <em class="label label-info">default</em>';?>     	</td>
                    <td><?php echo $val['code']	 ;?>		</td>
                    <td><?php echo $val['value'] ;?>		</td>
                    <td><?php echo dateformat($val['date_modified']) ;?>		</td>
                    <td>
                        <a href="<?php echo site_url('currency/update')."/".$val['id']; ?>" class="btn btn-xs btn-info" data-original-title="Update">
                            <i class="glyphicon glyphicon-edit glyphicon-white" ></i>
                        </a>
                        <a href="<?php echo site_url('currency/delete')."/".$val['id']; ?>" class="delete btn btn-xs btn-danger" data-original-title="Delete">
                            <i class="glyphicon glyphicon-trash glyphicon-white" ></i>
                        </a>
                    </td>
                </tr>
                </tbody><!-- Table Body -->
            <?php endforeach ?>
        </table>
        <nav class="pull-right">
            <?php echo $links ?>
        </nav>
        <?php endif ?>
    </div>
</div>