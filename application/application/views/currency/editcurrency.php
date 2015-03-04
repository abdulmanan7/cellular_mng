<?php if (!isset($updateCurrency)){echo "No Record Found";}?>
        <?php if(!empty($message)) {
        echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
  <div class="box box-primary">
        <div class="box-header with-border">
          <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> <?php echo lang('heading_update');?>
      </div>
      <div class="box-body">
 <?php  echo form_open('currency/update/'.$updateCurrency['id'],'class="form-horizontal" id="updateform" role="form"');  ?>

            <div class="form-group">
              <label for="title" class="control-label sr_only col-md-3"><?php echo lang('title_label'); ?></label>

              <div class="col-md-7">

             <?php echo form_input('title',$updateCurrency['title'], 'id="title" class="form-control" placeholder='.'"'.lang('placeholder_title').'"'."'");?>
              <span class="help-block error"><?php echo form_error('title'); ?></span>
              </div>
            </div>

             <div class="form-group">
              <label for="code" class="control-label sr_only col-md-3"><?php echo lang('code_label'); ?></label>

              <div class="col-md-7">

             <?php echo form_input('code',$updateCurrency['code'], 'id="code" class="form-control" id="code" placeholder='.'"'.lang('placeholder_code').'"'."'");?>
              <span class="help-block error"><?php echo form_error('code'); ?></span>
              </div>
            </div>

            <div class="form-group">
              <label for="symbol_left" class="control-label sr_only col-md-3"><?php echo lang('symbol_left_label'); ?></label>

               <div class="col-md-7">

               <?php echo form_input('symbol_left',$updateCurrency['symbol_left'], 'id="symbol_left" class="form-control"'.'placeholder='.'"'.lang('placeholder_symbol_left').'"'."'");?>
                <span class="help-block error"><?php echo form_error('symbol_left'); ?></span>
               </div>
            </div>
             <div class="form-group">
              <label for="symbol_right" class="control-label sr_only col-md-3"><?php echo lang('symbol_right_label'); ?></label>

               <div class="col-md-7">

               <?php echo form_input('symbol_right',$updateCurrency['symbol_right'], 'id="symbol_right" class="form-control"'.'placeholder='.'"'.lang('placeholder_symbol_right').'"'."'");?>
                <span class="help-block error"><?php echo form_error('symbol_right'); ?></span>
               </div>
            </div>

            <div class="form-group">
              <label for="decimal_place" class="control-label sr_only col-md-3"><?php echo lang('decimal_place_label'); ?></label>

               <div class="col-md-7">

              <?php echo form_input('decimal_place',$updateCurrency['decimal_place'], 'id="decimal_place" class="form-control"'.'placeholder='.'"'.lang('placeholder_decimal_place').'"'."'");?>
                <span class="help-block error"><?php echo form_error('decimal_place'); ?></span>
              </div>
            </div>
		    <div class="form-group">
		        <label for="value" class="control-label sr_only col-md-3"><?php echo lang('value_label'); ?></label>

             <div class="col-md-7">

            <?php echo form_input('value',$updateCurrency['value'],'id="value" class="form-control"'.'placeholder='.'"'.lang('placeholder_value').'"'."'");?>
		         <span class="help-block error"><?php echo form_error('value'); ?></span>
            </div>
        </div>

             <div class="form-group">
              <label for="status" class="control-label sr_only col-md-3"><?php echo lang('status_label'); ?></label>

               <div class="col-md-7">
                    <?php $options = array(
                                        '1'  => lang('view_status1_label'),
                                        '0'  => lang('view_status2_label'),
                                      );
                    if($updateCurrency["default"]==1) {
                        echo form_dropdown('status', $options, $updateCurrency['status'], 'class="form-control selectize-select" disabled="disabled"');
                        echo '<span class="help-block error">Default value cannot be disabled</span>';
                    }
                    else{
                        echo form_dropdown('status', $options, $updateCurrency['status'], 'class="form-control selectize-select"');
                    }
                    ?>
                </div>
             </div>
            <div class="form-group">
              <label for="default" class="control-label sr_only col-md-3"><?php echo lang('default_label'); ?></label>
                   <div class="col-md-7">
                    <?php $options = array(
                                        '0'  => lang('view_not_default_label'),
                                        '1'  => lang('view_default_label'),
                                      );
                    if($updateCurrency["default"]==1) {
                        echo form_dropdown('default', $options, $updateCurrency['default'], 'class="form-control selectize-select" disabled="disabled"');
                       echo '<span class="help-block error">Default value cannot be change,to make it disabled or Not Default first make another currency as default.</span>';
                    }
                    else{
                        echo form_dropdown('default', $options, $updateCurrency['default'], 'class="form-control selectize-select"');
                    }
                    ?>
                   </div>
               </div>
            <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('update_btn'); ?></button>
   <?php form_close();?>
</div>
<script>
  $(document).ready(function() {

    $('#updateform').validate(
      {
        rules: {
          title: {
            minlength: 2,
            required: true
          },
          code: {
            minlength: 1,
            required: true
          },
          decimal: {
            required: true,
            number: true
          },
          value: {
            required: true,
            number: true
          }
        }
      });
  });

</script>