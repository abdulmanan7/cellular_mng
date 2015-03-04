<?php if(!empty($message)): ?>
    <div class="pad margin no-print">
        <div class="alert alert-info" style="margin-bottom: 0!important;">
            <i class="fa fa-info"></i>
            <b>Note:</b> <?php echo $message; ?>
        </div>
    </div>
<?php endif ?>
<div class="panel panel">
    <div class="panel-heading with-border">
      <?php echo lang('heading_update');?>
      </div>
    <div class="panel-body">
        <?php if (!isset($updateaccount)){echo "No Record Found";}?>
        <?php  echo form_open('account/update/'.$updateaccount['id'],'class="form-horizontal" role="form"');  ?>

        <div class="form-group">
            <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>

            <div class="col-md-7">

             <?php echo form_input('name',$updateaccount['name'], 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
              <?php echo form_error('name'); ?>
              </div>
        </div>
        <div class="form-group">
            <label for="status" class="control-label sr_only col-md-3"><?php echo lang('status_label'); ?></label>

            <div class="col-md-7">

                    <?php
                      $options = array(
                                        '1'  => lang('view_status1_label'),
                                        '2'  => lang('view_status2_label'),
                                      );
                      echo form_dropdown('status',$options,$updateaccount['status'],'class="form-control selectize-select"'.'placeholder='.'"'.lang('placeholder_status').'"'."'");
                    ?>
                   </div>
        </div>

        <div class="form-group">
            <label for="system_acc" class="control-label sr_only col-md-3"><?php echo lang('system_acc_label'); ?></label>

            <div class="col-md-7">

                        <?php
                      $options = array(
                                        '0'  => lang('view_other_account_label'),
                                        '1'  => lang('view_system_account_label'),
                                      );
                      echo form_dropdown('system_acc',$options,$updateaccount['system_acc'],'class="form-control selectize-select"'.'placeholder='.'"'.lang('placeholder_system_acc').'"'."'");
                    ?>
                   </div>
        </div>

        <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('update_btn'); ?></button>
        <?php form_close(); ?>
    </div>
</div>