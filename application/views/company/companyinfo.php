<?php if (null!==$this->session->flashdata('message')) {
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
} ?>
<?php if (!empty($message)) {
    echo '<div class="alert alert-success">'
        . $message . '</div>';
}?>
<div class="row">
<div class="col-xs-6">
<div class="box">
    <div class="panel-heading with-border">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <?php echo lang('heading'); ?>

        <span class="pull-right"><?php echo anchor("company/changelogo/", lang('update_logo_btn'), 'class="btn btn-xs btn-success"'); ?>
            |
            <?php echo anchor('taxtype', lang('tax_setting_btn'), 'class="btn btn-info btn-xs"') ?>
            </span>
    </div>
    <div class="panel-body">
        <?php echo form_open('#', 'class="form-horizontal" role="form"'); ?>
        <?php if(!isset($record)){echo "No Record ";} ?>
        <div class="form-group">
            <label for="name" class="control-label col-xs-5"><?php echo lang('name_label'); ?>*</label>

            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['name']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="attn_name" class="control-label col-xs-5"><?php echo lang('attn_label'); ?>*</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['attn_name']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="address1" class="control-label col-xs-5"><?php echo lang('address1_label'); ?>
                *</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['address1']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="address2"
                   class="control-label col-xs-5"><?php echo lang('address2_label'); ?></label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['address2']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="city" class="control-label col-xs-5"><?php echo lang('city_label'); ?>*</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['city']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="state" class="control-label col-xs-5"><?php echo lang('state_label'); ?>*</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['state']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="country" class="control-label col-xs-5"><?php echo lang('country_label'); ?>
                *</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['country']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="postcode" class="control-label col-xs-5"><?php echo lang('postcode_label'); ?>*</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['postcode']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-xs-5"><?php echo lang('email_label'); ?>*</label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['email']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label col-xs-5"><?php echo lang('phone_label'); ?></label>

            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['phone']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="fax" class="control-label col-xs-5"><?php echo lang('fax_label'); ?></label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['fax']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="vat_no" class="control-label col-xs-5"><?php echo lang('vat_no_label'); ?></label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['VAT_no']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="registration_no"
                   class="control-label col-xs-5"><?php echo lang('registration_no_label'); ?></label>
            <div class="col-xs-7">
                <p class="form-control-static"><?php echo $record['registration_no']; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="footer_notes"
                   class="control-label col-xs-5"><?php echo lang('footer_notes_label'); ?></label>

            <div class="col-xs-7">
                <p class="form-control-static"><?php echo '<p>' . $record['footer_notes'] . '</p>'; ?></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-5"></div>
            <?php echo anchor("company/update/","<i class='glyphicon glyphicon-edit'></i> ".lang('edit_btn'),'class="btn btn-success"') ;?>
        </div>
        <?php form_close(); ?>
    </div>
</div>
    </div>
<div class="col-sm-6">
    <?php if (!empty($message)) {
        echo '<div class="alert alert-success">'
            . $message . '</div>';
    }?>
    <div class="panel panel">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> <?php echo lang('heading_update'); ?>
        </div>
        <?php echo form_open('company/update', 'class="form-horizontal" id="form" role="form"'); ?>
        <div class="panel-body">
            <div class="form-group">
                <label for="name" class="control-label sr_only"><?php echo lang('name_label'); ?>*</label>
                <?php echo form_input('name', $record['name'], 'id="name" class="form-control" id="name" placeholder=' . '"' . lang('placeholder_name') . '"' . "'"); ?>
                <?php echo form_error('name'); ?>
            </div>
            <div class="form-group">
                <label for="attn_name" class="control-label sr_only"><?php echo lang('attn_label'); ?>*</label>
                <?php echo form_input('attn_name', $record['attn_name'], 'id="name" class="form-control" placeholder=' . '"' . lang('placeholder_attn') . '"' . "'"); ?>
                <?php echo form_error('attn_name'); ?>
            </div>
            <div class="form-group">
                <label for="address1"
                       class="control-label sr_only"><?php echo lang('address1_label'); ?>*</label>
                <?php echo form_input('address1', $record['address1'], 'id="address1" class="form-control" placeholder=' . '"' . lang('placeholder_address1') . '"' . "'"); ?>
                <?php echo form_error('address1'); ?>
            </div>
            <div class="form-group">
                <label for="address2"
                       class="control-label sr_only"><?php echo lang('address2_label'); ?></label>
                <?php echo form_input('address2', $record['address2'], 'id="address2" class="form-control" placeholder=' . '"' . lang('placeholder_address2') . '"' . "'"); ?>
                <?php echo form_error('address2'); ?>
            </div>
            <div class="form-group">
                <label for="city" class="control-label"><?php echo lang('city_label'); ?>*</label>
                <?php echo form_input('city', $record['city'], 'id="city" class="form-control" placeholder="' . lang('placeholder_city') . '"' . "'"); ?>
                <?php echo form_error('city'); ?>
            </div>
            <div class="form-group">
                <label for="state" class="control-label"><?php echo lang('state_label'); ?></label>
                <?php echo form_input('state', $record['state'], 'id="state" class="form-control" placeholder="' . lang('placeholder_state') . '"' . "'"); ?>
                <?php echo form_error('state'); ?>
            </div>
            <div class="form-group">
                <label for="country" class="control-label"><?php echo lang('country_label'); ?></label>
                <?php echo form_input('country', $record['country'], 'id="Country" class="form-control" placeholder="' . lang('placeholder_country') . '"' . "'"); ?>
                <?php echo form_error('country'); ?>
            </div>
            <div class="form-group">
                <label for="postcode" class="control-label"><?php echo lang('postcode_label'); ?></label>
                <?php echo form_input('postcode', $record['postcode'], 'id="postcode" class="form-control" placeholder="' . lang('placeholder_postcode') . '"' . "'"); ?>
                <?php echo form_error('z_code'); ?>
            </div>
            <div class="form-group">
                <label for="email" class="control-label sr_only"><?php echo lang('email_label'); ?></label>
                <?php echo form_input('email', $record['email'], 'id="email" class="form-control" placeholder=' . '"' . lang('placeholder_email') . '"' . "'"); ?>
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label sr_only"><?php echo lang('phone_label'); ?></label>
                <?php echo form_input('phone', $record['phone'], 'id="phone" class="form-control" placeholder=' . '"' . lang('placeholder_phone') . '"' . "'"); ?>
                <?php echo form_error('phone'); ?>
            </div>
            <div class="form-group">
                <label for="fax" class="control-label sr_only"><?php echo lang('fax_label'); ?></label>
                <?php echo form_input('fax', $record['fax'], 'id="fax" class="form-control" placeholder=' . '"' . lang('placeholder_fax') . '"' . "'"); ?>
                <?php echo form_error('fax'); ?>
            </div>
            <div class="form-group">
                <label for="VAT_no"
                       class="control-label sr_only"><?php echo lang('vat_no_label'); ?></label>
                <?php echo form_input('VAT_no', $record['VAT_no'], 'id="VAT_no" class="form-control" placeholder=' . '"' . lang('placeholder_vat_no') . '"' . "'"); ?>
                <?php echo form_error('VAT_no'); ?>
            </div>
            <div class="form-group">
                <label for="registration_no"
                       class="control-label sr_only"><?php echo lang('registration_no_label'); ?></label>
                <?php echo form_input('registration_no', $record['registration_no'], 'id="registration_no" class="form-control" placeholder=' . '"' . lang('placeholder_registration_no') . '"' . "'"); ?>
                <?php echo form_error('registration_no'); ?>
            </div>
            <div class="form-group">
                <label for="footer_notes" class="control-label sr_only"><?php echo lang('footer_notes_label'); ?></label>
                <textarea id="bootstrap-editor" name="footer_notes" class="form-control"
                          placeholder="<?php echo lang('placeholder_footer_notes') ?>" style="height: 200px"><?php echo $record['footer_notes'] ?></textarea>
                <?php echo form_error('footer_notes'); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><?php echo lang('update_btn'); ?></button>
            </div>
        </div>
        <?php form_close(); ?>
    </div>
</div>
    </div><!-- top row