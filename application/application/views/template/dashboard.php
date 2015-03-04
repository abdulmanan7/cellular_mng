<?php

if (! empty ( $message )) {
	echo '<div class="alert alert-success">' . $message . '</div>';
}
?>
<!-- Error Reporting -->
<div class="col-md-8 col-xs-12">
	<div class="box box-danger">
		<div class="box-header">
			<i class="fa fa-bar-chart-o"></i>
			<h3 class="box-title"> <?php echo lang('heading_statistics'); ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="col-md-3 col-xs-12">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>
                            <?php echo $invoices?>
                        </h3>
							<p>
                            <?php echo lang('heading_invoice'); ?>
                        </p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?php echo site_url('invoice'); ?>"
							class="small-box-footer">
                        <?php echo lang('more_btn'); ?> <i
							class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-md-3 col-xs-12">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>
                            <?php echo $products?>
                        </h3>
							<p>
                            <?php echo lang('heading_products'); ?>
                        </p>
						</div>
						<div class="icon">
							<i class="ion ion-ios7-pricetag-outline"></i>
						</div>
						<a href="<?php echo site_url('products'); ?>"
							class="small-box-footer">
                        <?php echo lang('more_btn'); ?> <i
							class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-md-3 col-xs-12">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>
                            <?php echo $customers?>
                        </h3>
							<p>
                            <?php echo lang('heading_customers'); ?>
                        </p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="<?php echo site_url('customer'); ?>"
							class="small-box-footer">
                        <?php echo lang('more_btn'); ?> <i
							class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-md-3 col-xs-12">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>
                            <?php echo $users_count?>
                        </h3>
							<p>
                            <?php echo lang('heading_users'); ?>
                        </p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="<?php echo site_url('auth'); ?>" class="small-box-footer">
                        <?php echo lang('more_btn'); ?> <i
							class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<div class="col-md-4 col-xs-12">
	<div class="box box-danger">
		<div class="box-header">
			<h3 class="box-title"><?php echo lang('heading_invoice_ratio'); ?></h3>
		</div>
		<div class="box-body chart-responsive">
			<div class="chart" id="sales-chart"	style="height: 150px; position: relative;"></div>
		</div>
	</div>
</div>
<!-- /invoice ration -->
<div class="col-md-6 col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
            <?php echo lang('heading_users'); ?>
            <span class="pull-right"><a
				href="<?php echo site_url('auth/create_user'); ?>"
				class="btn btn-xs btn-success"><i
					class="glyphicon glyphicon-plus glyphicon-white" id="edit"></i> <?php echo lang('add_btn'); ?></a></span>
		</div>
		<div class="box-body no-padding">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo lang('index_fname_th');?></th>
						<th><?php echo lang('index_lname_th');?></th>
						<th><?php echo lang('index_status_th');?></th>
						<th class="text-right"><?php echo lang('index_action_th');?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
                    <?php foreach ($users as $user):?>



					<tr>
						<td><?php echo htmlspecialchars($user['first_name'],ENT_QUOTES,'UTF-8');?></td>
						<td><?php echo htmlspecialchars($user['last_name'],ENT_QUOTES,'UTF-8');?></td>

						<td><?php echo ($user['active']) ? anchor("auth/deactivate/".$user['id'], lang('index_active_link')) : anchor("auth/activate/". $user['id'], lang('index_inactive_link'));?></td>
						<td class="text-right"><a
							href="auth/edit_user/<?php echo $user['id'];?>"
							class="btn btn-xs btn-success"> <i
								class="glyphicon glyphicon-pencil glyphicon-white"></i> Edit
						</a> <a href="auth/delete_user/<?php echo $user['id'];?>"
							class="delete btn btn-xs btn-danger"> <i
								class="glyphicon glyphicon-remove glyphicon-white"></i> <?php echo lang('index_del_link'); ?></a>
						</td>
					</tr>
                <?php endforeach;?>
                </tbody>
			</table>
		</div>
	</div>
</div>
<!-- Users -->
<div class="col-sm-6 col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
            <?php echo lang('heading_products'); ?>
            <span class="pull-right"><a
				href="<?php echo site_url('products/add'); ?>"
				class="btn btn-xs btn-success"><i
					class="glyphicon glyphicon-plus glyphicon-white" id="edit"></i><?php echo lang('add_btn'); ?></a></span>
		</div>
		<div class="box-body no-padding">
            <?php if (empty($allproducts)): ?>
                <div class="no-data"><?php echo lang('msg_no_data'); ?></div>
            <?php else: ?>
            <table class="table">
				<thead>
					<tr>
						<th>    <?php echo lang('pro_name_label'); ?>          </th>
						<th>    <?php echo lang('pro_type_label');?>           </th>
						<th>    <?php echo lang('pro_price_label');?>          </th>
						<th>    <?php echo lang('pro_action'); ?>              </th>

					</tr>
				</thead>
                <?php foreach($allproducts as $key) :?>
                    <tbody>
					<tr>
						<td><?php echo $key['name'];?></td>
						<td><?php echo ($key['type']=='1'?lang('pro_type1_label'):lang('pro_type2_label'));?></td>
						<td><?php echo $key['price'];?></td>
						<td>
							<div class="dropdown">
								<button type="button"
									class="btn btn-info btn-xs dropdown-toggle"
									data-toggle="dropdown" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span><?php echo lang('pro_action');?>
                                    <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><?php echo anchor("products/update/".$key['id'],lang('edit_btn')) ;?></li>
									<li class="divider"></li>
									<li> <?php echo anchor("products/delete/".$key['id'],lang('del_btn')) ;?></li>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
                <?php endforeach ?>
                <?php endif;?>
                </table>
		</div>
	</div>
</div>
<!--/col-sm-6-->
<div class="col-sm-6 col-xs-12">
	<div class="box box-primary">
		<div class="box-header">
            <?php echo lang('heading_customers'); ?>
            <span class="pull-right"> <a
				href="<?php echo site_url('customer/add'); ?>"
				class="btn btn-xs btn-success"> <i
					class="glyphicon glyphicon-plus glyphicon-white" id="edit"></i>
                                <?php echo lang('add_btn'); ?>
                            </a>
			</span>
		</div>
		<div class="box-body no-padding">
            <?php if (empty($allcustomer)): ?>
                <div class="no-data"><?php echo lang('msg_no_data'); ?></div>
            <?php else: ?>
            <table class="table">
				<thead>
					<tr>
						<th>    <?php echo lang('cus_name_label'); ?>          </th>
						<th>    <?php echo lang('cus_company_name_label');?>   </th>
						<th>    <?php echo lang('cus_phone_label');?>          </th>
						<th>    <?php echo lang('cus_action'); ?>              </th>
					</tr>
				</thead>
                <?php foreach($allcustomer as $val) :?>
                    <tbody>
					<tr>
						<td><?php echo $val['name']        ;?></td>
						<td><?php echo $val['company_name'];?></td>
						<td><?php echo $val['phone']       ;?></td>
						<td>
							<div class="dropdown">
								<button type="button"
									class="btn btn-info btn-xs dropdown-toggle"
									data-toggle="dropdown" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span><?php echo lang('cus_action');?>
                                    <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><?php echo anchor("customer/update/".$val['id'],lang('edit_btn')) ;?></li>
									<li class="divider"></li>
									<li> <?php echo anchor("customer/delete/".$val['id'],lang('del_btn')) ;?></li>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
                <?php endforeach ?>
                <?php endif;?>
               </table>
		</div>
	</div>
</div>
<!-- customer -->
<div class="col-sm-6 col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
            <?php echo lang('heading_invoice'); ?>
            <span class="pull-right"> <a
				href="<?php echo site_url('invoice/add'); ?>"
				class="btn btn-xs btn-success"> <i class="glyphicon glyphicon-plus"
					id="edit"></i>
                                <?php echo lang('add_btn'); ?>
                            </a>
			</span>
		</div>
		<div class="box-body no-padding">
			<table class="table">
                <?php if (empty($allinvoice)): ?>
                    <div class="no-data"><?php echo lang('msg_no_data'); ?></div>
                <?php else: ?>
                    <thead>
					<tr>
						<th>    <?php echo lang('inv_date_label'); ?>          </th>
						<th>    <?php echo lang('inv_customer_name_label');?>  </th>
						<th class="text-right"> <?php echo lang('inv_total_label');?>      </th>
						<th>    <?php echo lang('inv_action'); ?>              </th>
					</tr>
				</thead>
				<!-- table head -->
                    <?php foreach($allinvoice as $val) :?>
                        <tbody>
					<tr>
						<td><?php echo dateformat($val['current_time_stamp'])  ;?></td>
						<td><?php echo $val['customer_name'];?></td>
						<td><span class="pull-right"><?php echo $val['currency_symbol_left'];?><?php echo floatFormat($val['total']);?><?php echo " ". $val['currency_symbol_right']     ;?></td>
						<td>
							<div class="dropdown">
								<button type="button"
									class="btn btn-info btn-xs dropdown-toggle"
									data-toggle="dropdown" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span><?php echo lang('inv_action');?>
                                        <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><?php echo anchor("invoice/singleinvoice/".$val['id'],lang('view_btn')) ;?></li>
									<li><?php echo anchor("invoice/update/".$val['id'],lang('edit_btn')) ;?></li>
									<li><?php echo anchor("invoice/getpdf/".$val['id'],lang('get_pdf_btn')) ;?></li>
									<!-- Button to trigger modal -->
									<li><a href="#emailmodal" class="btninv_st" data-toggle="modal"
										data-id="<?php echo $val["id"] ?>"
										data-cemail="<?php echo $val["customer_email"] ?>"
										data-cname="<?php echo $val["customer_name"] ?>"
										data-target="#emailmodal")><?php echo lang('email_btn'); ?> </a></li>
									<li class="divider"></li>
									<li> <?php echo anchor("invoice/delete/".$val['id'],lang('del_btn')) ;?></li>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
                    <?php endforeach ?>
                <?php endif;?>
              </table>
		</div>
	</div>
</div>
<!-- invoice -->
<script type="text/javascript">
    $(function() {
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["#3c8dbc", "#f56954", "#00a65a"],
            data: [
                {label: "Paid Invoice (%)", value: <?php echo $status['paid'] ? $status['paid'] : 0 ?>},
//            {label: "In-Store Sales", value: <?php //echo $status['total_invoice'] ? $status['total_invoice'] : 0 ?>//},
                {label: "Unpaid Invoice (%)", value: <?php echo $status['unpaid'] ? $status['unpaid'] : 0 ?>}
            ],
            hideHover: 'auto'
        });
    });

</script>
