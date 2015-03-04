<?php if(!empty($message)) {
        echo '<div class="alert alert-success">'
        .$message.'</div>';}?>
          <section class="custom-page">
	<div class="col-xs-12">
		<h4 class="page-header">
			<i class="glyphicon glyphicon-edit" aria-hidden="true"></i> <?php echo lang('heading_add');?>       
		</h4>
	</div>
	<!-- /.col -->
  <div class="panel">
      <div class="panel-body">
 <?php  echo form_open('products/add','id="form" class="form-horizontal" role="form"');  ?>

            <div class="form-group">
              <label for="name" class="control-label sr_only col-md-3"><?php echo lang('name_label'); ?></label>

              <div class="col-md-7">

             <?php echo form_input('name',set_value('name'), 'id="name" class="form-control"'.'placeholder='.'"'.lang('placeholder_name').'"'."'");?>
              <?php echo form_error('name'); ?>
              </div>
            </div>


               <div class="form-group">
                  <label class="col-md-3 control-label" for="type"><?php echo lang('type_label'); ?></label>
                  <div class="col-md-7">
                      <?php
                      $options = array(
                                        '1'  => lang('view_type1_label'),
                                        '2'  => lang('view_type2_label'),
                                      );
                      echo form_dropdown('type',$options,'1','class="form-control selectize-select"'.'placeholder='.'"'.lang('placeholder_type').'"'."'");
                    ?>
                </div>
                </div>
             <div class="form-group">
              <label for="price" class="control-label sr_only col-md-3"><?php echo lang('price_label'); ?></label>

                 <div class="col-md-7">

                 <?php echo form_input('price',set_value('price'), 'id="price" class="form-control"'.'placeholder='.'"'.lang('placeholder_price').'"'."'");?>
              <?php echo form_error('price'); ?>
              </div>
            </div>

          <div class="form-group">
              <label for="notes" class="control-label sr_only col-md-3"><?php echo lang('notes_label'); ?></label>

              <div class="col-md-7">

              <?php echo form_input('notes',set_value('notes'), 'id="notes" class="form-control"'.'placeholder='.'"'.lang('placeholder_notes').'"'."'");?>
                <?php echo form_error('notes'); ?>
              </div>
           </div>


          <button type="submit" class="col-md-offset-3 btn btn-primary"><?php echo lang('create_btn'); ?></button>
   <?php form_close(); ?>
</div>
</div>
</section>
<script>
  $(document).ready(function() {

    $('#form').validate(
      {
        rules: {
          name: {
            minlength: 2,
            required: true
          },
          price: {
            minlength: 2,
            required: true
          },
        }
      });
  });

</script>