<div class="row">
    <div class="col-sm-12">
        <?php if (!empty($message)) {
            echo '<div class="alert alert-success">'
                . $message . '</div>';
        }?>
        <div class="panel panel">
            <?php echo form_open('company/update', 'class="form-horizontal" id="form" role="form"'); ?>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name" class="control-label col-xs-3 sr_only"><?php echo lang('name_label'); ?>*</label>
                    <div class="col-xs-9">
                    <?php echo form_input('name', $record['name'], 'id="name" class="form-control" id="name" placeholder=' . '"' . lang('placeholder_name') . '"' . "'"); ?>
                    <?php echo form_error('name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="attn_name" class="control-label col-xs-3 sr_only"><?php echo lang('attn_label'); ?>*</label>
                    <div class="col-xs-9">
                        <?php echo form_input('attn_name', $record['attn_name'], 'id="name" class="form-control" placeholder=' . '"' . lang('placeholder_attn') . '"' . "'"); ?>
                        <?php echo form_error('attn_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address1"
                           class="control-label col-xs-3 sr_only"><?php echo lang('address1_label'); ?>*</label>
                    <div class="col-xs-9">
                        <?php echo form_input('address1', $record['address1'], 'id="address1" class="form-control" placeholder=' . '"' . lang('placeholder_address1') . '"' . "'"); ?>
                        <?php echo form_error('address1'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address2"
                           class="control-label col-xs-3 sr_only"><?php echo lang('address2_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('address2', $record['address2'], 'id="address2" class="form-control" placeholder=' . '"' . lang('placeholder_address2') . '"' . "'"); ?>
                        <?php echo form_error('address2'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="control-label col-xs-3 sr_only"><?php echo lang('city_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('city', $record['city'], 'id="city" class="form-control" placeholder="' . lang('placeholder_city') . '"' . "'"); ?>
                        <?php echo form_error('city'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="state" class="control-label col-xs-3 sr_only"><?php echo lang('state_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('state', $record['state'], 'id="state" class="form-control" placeholder="' . lang('placeholder_state') . '"' . "'"); ?>
                        <?php echo form_error('state'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label col-xs-3 sr_only"><?php echo lang('country_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('country', $record['country'], 'id="Country" class="form-control" placeholder="' . lang('placeholder_country') . '"' . "'"); ?>
                        <?php echo form_error('country'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="postcode" class="control-label col-xs-3 sr_only"><?php echo lang('postcode_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('postcode', $record['postcode'], 'id="postcode" class="form-control" placeholder="' . lang('placeholder_postcode') . '"' . "'"); ?>
                        <?php echo form_error('z_code'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-xs-3 sr_only"><?php echo lang('email_label'); ?>*</label>
                    <div class="col-xs-9">
                        <?php echo form_input('email', $record['email'], 'id="email" class="form-control" placeholder=' . '"' . lang('placeholder_email') . '"' . "'"); ?>
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label col-xs-3 sr_only"><?php echo lang('phone_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('phone', $record['phone'], 'id="phone" class="form-control" placeholder=' . '"' . lang('placeholder_phone') . '"' . "'"); ?>
                        <?php echo form_error('phone'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fax" class="control-label col-xs-3 sr_only"><?php echo lang('fax_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('fax', $record['fax'], 'id="fax" class="form-control" placeholder=' . '"' . lang('placeholder_fax') . '"' . "'"); ?>
                        <?php echo form_error('fax'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="VAT_no"
                           class="control-label col-xs-3 sr_only"><?php echo lang('vat_no_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('VAT_no', $record['VAT_no'], 'id="VAT_no" class="form-control" placeholder=' . '"' . lang('placeholder_vat_no') . '"' . "'"); ?>
                        <?php echo form_error('VAT_no'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="registration_no"
                           class="control-label col-xs-3 sr_only"><?php echo lang('registration_no_label'); ?></label>
                    <div class="col-xs-9">
                        <?php echo form_input('registration_no', $record['registration_no'], 'id="registration_no" class="form-control" placeholder=' . '"' . lang('placeholder_registration_no') . '"' . "'"); ?>
                        <?php echo form_error('registration_no'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="footer_notes" class="control-label col-xs-3 sr_only"><?php echo lang('footer_notes_label'); ?></label>
                    <div class="col-xs-9">
                        <textarea id="bootstrap-editor" name="footer_notes" class="form-control"
                                  placeholder="<?php echo lang('placeholder_footer_notes') ?>" style="height: 200px"><?php echo $record['footer_notes'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6 col-xs-offset-3">
                        <button type="submit" class="btn btn-primary"><?php echo lang('update_btn'); ?></button>
                    </div>
                </div>
            </div>
            <?php form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/editor/wysihtml5.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/editor/core-b3.js'); ?>"></script>
<script>
    $(document).ready(function () {
        jQuery.validator.setDefaults({
            errorPlacement: function (error, element) {
                // if the input has a prepend or append element, put the validation msg after the parent div
                if (element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
                    error.insertAfter(element.parent());
                    // else just place the validation message immediatly after the input
                } else {
                    error.insertAfter(element);
                }
            },
            errorElement: "small", // contain the error msg in a small tag
            wrapper: "div", // wrap the error message and small tag in a div
            highlight: function (element) {
                $(element).closest('.form-group').addClass('error'); // add the Bootstrap error class to the control group
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('error'); // remove the Boostrap error class from the control group
            }
        });
        $(function () {
            $('#bootstrap-editor').wysihtml5({
                stylesheets: [
                    '<?php echo base_url("assets/css/wysiwyg-color.css"); ?>'
                ]
            });
        });
        $('#form').validate(
            {
                rules: {
                    name: {
                        minlength: 5,
                        required: true
                    },
                    attn_name: {
                        minlength: 2,
                        required: true
                    },
                    address1: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                }
            });
    });
</script>