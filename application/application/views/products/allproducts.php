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
  <section class="content custom-page">
	<div class="col-xs-12">
		<h2 class="page-header">
			 <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> <?php echo lang('heading'); ?>
			<a href="<?php echo site_url('products/add'); ?>" class="btn btn-xs btn-success pull-right"><i class="glyphicon glyphicon-plus glyphicon-white" id="edit"></i> <?php echo lang('heading_add'); ?></a>
		</h2>
	</div>
	<!-- /.col -->
	<div class="row content">
<div class="box box-warning">
    <div class="box-body">
        <?php if (empty($allproducts)): ?>
            <p class="no-data">No Record Added Yet.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>	<?php echo lang('view_name_label'); ?>			</th>
                    <th>	<?php echo lang('view_type_label');?>			</th>
                    <th>	<?php echo lang('view_price_label');?>			</th>
                    <th>	<?php echo lang('view_notes_label'); ?>			</th>
                    <th>	<?php echo lang('view_action'); ?>				</th>

                </tr>
                </thead>
                <?php foreach($allproducts as $key) :?>

                    <tbody>

                    <tr>

                        <td><?php echo $key['name'];?></td>
                        <td><?php echo ($key['type']=='1'?lang('view_type1_label'):lang('view_type2_label'));?></td>
                        <td><?php echo $key['price'];?></td>
                        <td><?php echo $key['notes'];?></td>
                        <td>
                            <a href="<?php echo site_url('products/update')."/".$key['id']; ?>" class="btn btn-xs btn-info" data-original-title="Update">
                                <i class="glyphicon glyphicon-edit glyphicon-white" ></i>
                            </a>
                            <a href="<?php echo site_url('products/delete')."/".$key['id']; ?>" class="delete btn btn-xs btn-danger" data-original-title="Delete">
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
</div>
</section>