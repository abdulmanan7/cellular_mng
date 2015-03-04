<?php if (null!==$this->session->flashdata('message')) {
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
} ?>
<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'.$message.'</div>';}
?>
    <section class="custom-page">
	<div class="col-xs-12">
		<h2 class="page-header">
 <i class="glyphicon glyphicon-user" aria-hidden="true"></i> <?php echo lang('heading_view');?>
 <span class="pull-right"><a href="<?php echo site_url('customer/add'); ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus glyphicon-white" id="edit"></i> <?php echo lang('create_btn'); ?></a></span>
		</h2>
	</div>
	<!-- /.col -->
	<div class="showback">
<div class="panel panel">
    <?php if (empty($allcustomer)): ?>
        <div class="no-data">No Record Added Yet.</div>
    <?php else: ?>
    <div class="box-body no-padding">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>	<?php echo lang('view_name_label'); ?>			</th>
                <th>	<?php echo lang('view_company_name_label');?>	</th>
                <th>	<?php echo lang('view_attn_label'); ?>			</th>
                <th>	<?php echo lang('view_address_label');?>		</th>
                <th>	<?php echo lang('view_phone_label');?>			</th>
                <th>	<?php echo lang('view_email_label'); ?>			</th>
                <th>	<?php echo lang('view_action'); ?>				</th>

            </tr>
            </thead>
            <?php foreach($allcustomer as $val) :?>
                <tbody>
                <tr>
                    <td><?php echo $val['name']        ;?></td>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['attn_name']   ;?></td>
                    <td><?php echo $val['address1']     ;?></td>
                    <td><?php echo $val['phone']       ;?></td>
                    <td><?php echo $val['email']       ;?></td>
                    <td>
                        <a href="<?php echo site_url('customer/update')."/".$val['id']; ?>" class="btn btn-xs btn-info" data-original-title="Update">
                            <i class="glyphicon glyphicon-edit glyphicon-white" ></i>
                        </a>
                        <a href="<?php echo site_url('customer/delete')."/".$val['id']; ?>" class="delete btn btn-xs btn-danger" data-original-title="Delete">
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
</div><!-- panel body -->
	</div>
	</section>