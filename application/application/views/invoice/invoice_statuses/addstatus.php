<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
<div class="box box-primary">
    <?php  echo form_open('invoice/save_invoice_status','class="form-horizontal" id="form" role="form"');  ?>
    <div class="box-body">
        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('status_name_label'); ?></label>
            <div class="col-md-7">
                            <?php echo form_input('name',set_value('name'), 'id="name" class="form-control" placeholder='.'"'.lang('status_placeholder_name').'"'."'");?>
                            <?php echo form_error('name'); ?>
                        </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
            <label for="is_enable">
                <input type="checkbox" name="is_enable" checked value="1" class="minimal-green" /><?php echo lang('status_is_enable_label'); ?>
            </label>
            </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
            <label for="is_default">
                <input type="checkbox" name="is_deafult" value="0" class="minimal-red" /><?php echo lang('status_is_default_label'); ?>
            </label>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('status_add_new_btn'); ?></button>
    </div>
    <?php form_close(); ?>
</div>