<?php if (!empty($message)): ?>
    <div class="pad margin no-print">
        <div class="alert alert-info" style="margin-bottom: 0!important;">
            <i class="fa fa-info"></i>
            <b>Note:</b> <?php echo $message; ?>
        </div>
    </div>
<?php endif ?>
<div class="box box-primary">
    <?php  echo form_open('account/add','id="addform" class="form-horizontal" role="form"');  ?>
    <div class="box-body">
        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>
            <div class="col-md-7">
                   <?php echo form_input('name',set_value('name'), 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
                   <?php echo form_error('name'); ?>
                </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="status" checked value="1"><?php echo lang('enable_label'); ?>
            </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="system_acc" value="1"><?php echo lang('system_acc_label'); ?>
            </div>
        </div>
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('add_new_btn'); ?></button>
    </div>
    <?php form_close(); ?>
</div>
<script>
    $(document).ready(function() {
        $('#addform').validate(
            {
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    }
                }
            });
    });
</script>