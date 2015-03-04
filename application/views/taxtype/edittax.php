<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
        <div class="col-xs-12">
            <h4 class="page-header">
        <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> <?php echo lang('heading_update');?>
    </h4>
<div class="panel">
    <div class="panel-body">
        <?php if (!isset($updatetax)){echo "No Record Found";}?>
        <?php  echo form_open('taxtype/update/'.$updatetax['id'],'id="form" class="form-horizontal" role="form"');  ?>

        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>
            <div class="col-md-7">
                <?php echo form_input('name',$updatetax['name'], 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
              <?php echo form_error('name'); ?>
              </div>
        </div>
        <div class="form-group">
            <label for="percentage" class="control-label sr_only col-md-3"><?php echo lang('percentage_label'); ?></label>
            <div class="col-md-7">
                 <?php echo form_input('percentage',$updatetax['percentage'], 'id="percentage" class="form-control"'.'placeholder='.'"'.lang('placeholder_percentage').'"'."'");?>
              <?php echo form_error('percentage','<div class="alert alert-success">', '</div>'); ?>
              </div>
        </div>
        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('update_btn'); ?></button>
        <?php form_close();?>
    </div>
    </div>
<script>
    $(document).ready(function() {

        $('#form').validate(
            {
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    percentage: {
                        required: true
                    },
                }
            });
    });

</script>
