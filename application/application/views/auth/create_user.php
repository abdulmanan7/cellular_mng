   <section class="content custom-page">
	<div class="col-xs-12">
		<h2 class="page-header">
 <i class="glyphicon glyphicon-plus"></i> Add New User
		</h2>
	</div>
	<!-- /.col -->
	<div class="row content">
<div class="box box-primary">
    <div class="box-body">
        <?php echo form_open("auth/create_user", 'class="form-horizontal"'); ?>

        <?php if(isset($message) && $message!="") : ?>
            <div class="alert alert-danger"><?php echo $message;?></div>
        <?php endif; ?>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="first_name">First Name</label>
            <div class="col-lg-10">
                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->

                <?php echo form_input($first_name, 'placeholder="First Name"', 'class="form-control"'); ?>
                <p class="help-block"><?php form_error('name'); ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="last_name">Last Name</label>
            <div class="col-lg-10">
                                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->
                                <?php echo form_input($last_name, 'placeholder="Last Name"', 'class="form-control"'); ?>
                            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="email">Email</label>
            <div class="col-lg-10">
                                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->
                                <?php echo form_input($email, 'placeholder="Enter Email"', 'class="form-control"'); ?>
                            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="phone">Phone</label>
            <div class="col-lg-10">
                                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->
                                <?php echo form_input($phone, 'placeholder="Phone Number"', 'class="form-control"'); ?>
                            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="password">Password</label>
            <div class="col-lg-10">
                                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->
                                <?php echo form_input($password, 'placeholder="Enter Password"', 'class="form-control"'); ?>
                            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="password_confirm">Confirm Password</label>
            <div class="col-lg-10">
                                <!-- <input class="form-control" id="phone" type="text" value="This is focused..."> -->
                                <?php echo form_input($password_confirm, 'placeholder="Confirm Password"', 'class="form-control"'); ?>
                            </div>
        </div>

        <div class="text-right"><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn btn-primary"'); ?></div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
</section>