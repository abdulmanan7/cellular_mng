<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
<div class="panel panel">
    <?php  echo form_open('invoice/save_invoice_status','class="form-horizontal" id="form" role="form"');  ?>
    <div class="panel-body">
        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('status_name_label'); ?></label>
            <div class="col-md-7">
                            <?php echo form_input('name',set_value('name'), 'id="name" class="form-control" placeholder='.'"'.lang('status_placeholder_name').'"'."'");?>
                            <?php echo form_error('name'); ?>
                        </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="is_enable" checked value="1"><?php echo lang('status_is_enable_label'); ?>
            </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="is_default" value="0"><?php echo lang('status_is_default_label'); ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('status_add_new_btn'); ?></button>
    </div>
    <?php form_close(); ?>
</div>