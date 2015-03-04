<?php if(!empty($message)) {
                echo '<div class="alert alert-success">'
                    .$message.'</div>';}?>
                       <section class="custom-page">
	<div class="col-xs-12">
		<h2 class="page-header">
 <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> <?php echo lang('heading_update');?>
		</h2>
	</div>
	<!-- /.col -->
	<div class="showback">
            <div class="panel panel">
                <div class="panel-body">
                    <?php if (!isset($updateCustomer)){echo "No Record Found";}?>
                    <?php  echo form_open('customer/update/'.$updateCustomer['id'],'class="form-horizontal" id="form" role="form"');  ?>
                    <div class="form-group">
                        <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>
                        <div class="col-md-7">
                            <?php echo form_input('name',$updateCustomer['name'], 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
                            <span class="help-block error"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_name" class="control-label sr_only col-md-3"><?php echo lang('company_name_label'); ?></label>
                        <div class="col-md-7">
                            <?php echo form_input('company_name',$updateCustomer['company_name'], 'id="company_name" class="form-control" id="company_name"'.'placeholder='.'"'.lang('placeholder_company_name').'"'."'");?>
                            <span class="help-block error"><?php echo form_error('company_name','<div class="alert alert-success">', '</div>'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="attn_name" class="control-label sr_only col-md-3"><?php echo lang('attn_label'); ?></label>
                        <div class="col-md-7">
                            <?php echo form_input('attn_name',$updateCustomer['attn_name'], 'id="attn_name" class="form-control"'.'placeholder='.'"'.lang('placeholder_attn').'"'."'");?>
                            <span class="help-block error"><?php echo form_error('attn_name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address1"
                               class="control-label sr_only col-md-3"><?php echo lang('address1_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('address1', $updateCustomer['address1'], 'id="address1" class="form-control" placeholder="' . lang('placeholder_address1') . '"' . "'"); ?>
                            <?php echo form_error('address1'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address2"
                               class="control-label sr_only col-md-3"><?php echo lang('address2_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('address2', $updateCustomer['address2'], 'id="address2" class="form-control" placeholder="' . lang('placeholder_address2') . '"' . "'"); ?>
                            <?php echo form_error('address2'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city"
                               class="control-label sr_only col-md-3"><?php echo lang('city_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('city', $updateCustomer['city'], 'id="city" class="form-control" placeholder="' . lang('placeholder_city') . '"' . "'"); ?>
                            <?php echo form_error('city'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="state"
                               class="control-label sr_only col-md-3"><?php echo lang('state_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('state', $updateCustomer['state'], 'id="state" class="form-control" placeholder="' . lang('placeholder_state') . '"' . "'"); ?>
                            <?php echo form_error('state'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country"
                               class="control-label sr_only col-md-3"><?php echo lang('country_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('country', $updateCustomer['country'], 'id="country" class="form-control" placeholder="' . lang('placeholder_country') . '"' . "'"); ?>
                            <?php echo form_error('country'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postcode"
                               class="control-label sr_only col-md-3"><?php echo lang('postcode_label'); ?></label>

                        <div class="col-md-7">
                            <?php echo form_input('postcode', $updateCustomer['postcode'], 'id="postcode" class="form-control" placeholder="' . lang('placeholder_postcode') . '"' . "'"); ?>
                            <?php echo form_error('postcode'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label sr_only col-md-3"><?php echo lang('email_label'); ?></label>
                        <div class="col-md-7">
                            <?php echo form_input('email',$updateCustomer['email'],'id="email" class="form-control"'.'placeholder='.'"'.lang('placeholder_email').'"'."'");?>
                            <span class="help-block error"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="control-label sr_only col-md-3"><?php echo lang('phone_label'); ?></label>
                        <div class="col-md-7">
                            <?php echo form_input('phone',$updateCustomer['phone'], 'id="phone" class="form-control"'.'placeholder='.'"'.lang('placeholder_phone').'"'."'");?>
                            <span class="help-block error"><?php echo form_error('phone'); ?></span>
                        </div>
                    </div>
                    <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('update_btn'); ?></button>
                    <?php form_close();?>
                </div>
            </div>
            </div>
            </section>
        <script>
            $(document).ready(function() {

                $('#form').validate(
                    {
                        rules: {
                            name: {
                                minlength: 2,
                                required: true
                            },
                            company_name: {
                                minlength: 2,
                                required: true
                            },
                            address: {
                                required: true,
                                minlength:5
                            },
                            email: {
                                required: true,
                                email: true
                            }
                        }
                    });
            });

        </script>