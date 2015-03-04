<?php if (!isset($updatestatus)){echo "No Record Found";}?>
<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
<div class="box">
    <div class="box-header with-border">
      <?php echo lang('status_heading_add');?>
      </div>
    <?php  echo form_open('invoice/save_invoice_status/'.$updatestatus['id'],'class="form-horizontal" role="form"');  ?>
    <div class="box-body">

        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('status_name_label'); ?></label>

            <div class="col-md-7">

                <?php echo form_input('name',$updatestatus['name'], 'id="name" class="form-control"'.'placeholder='.'"'.lang('status_placeholder_name').'"'."'");?>
              <?php echo form_error('name'); ?>
              </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="is_enable" value="1" <?php echo $updatestatus['is_enable'] ? 'checked' : '' ?>><?php echo lang('status_is_enable_label'); ?>
            </div>
        </div>
        <div class="checkbox">
            <div class="col-md-3 col-md-offset-3">
                <input type="checkbox" name="is_default" value="1" <?php echo $updatestatus['is_default'] ? 'checked' : '' ?>><?php echo lang('status_is_default_label'); ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('status_update_btn'); ?></button>
    </div>
    <?php form_close(); ?>
</div>
<script>
    $(document).ready(function() {

        $('#form').validate(
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