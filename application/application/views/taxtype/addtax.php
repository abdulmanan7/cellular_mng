<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
<div class="box box-primary">

    <?php  echo form_open('taxtype/add','id="addform" class="form-horizontal" role="form"');  ?>
    <div class="box-body">
        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>
            <div class="col-md-7">
                            <?php echo form_input('name',set_value('name'), 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
                            <?php echo form_error('name'); ?>
                        </div>
        </div>

        <div class="form-group">
            <label for="percentage" class="control-label sr_only col-md-3"><?php echo lang('percentage_label'); ?></label>
            <div class="col-md-7">
                            <?php echo form_input('percentage',set_value('percentage'), 'id="percentage" class="form-control" id="percentage"'.'placeholder='.'"'.lang('placeholder_percentage').'"'."'");?>
                            <?php echo form_error('percentage'); ?>
                        </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('add_new_btn'); ?></button>
    </div>
    <?php form_close(); ?>
</div>