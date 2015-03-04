<?php if (null!==$this->session->flashdata('message')) {
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
} ?>
<?php if(!isset($record)){echo "No Record ";} ?>
<?php if(!empty($message)) {
    echo '<div class="alert alert-danger">'
        .$message.'</div>';}?>
        <div class="custom-page">
    <div class="row">
        <div class="col-xs-12">
<div class="panel">
        <i class="glyphicon glyphicon-picture" aria-hidden="true"></i>
        <?php echo lang('heading_change_logo');?>
    <div class="panel-body">
        <?php  echo form_open_multipart('company/do_upload','class="form-horizontal" role="form"');  ?>
        <div class="form-group">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="#"><img src="<?php echo base_url();echo $record['logo']; ?>"></a>
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="input-group input-prepend">
                    <div class="form-group">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <span class="help-block">Supported Files jpg,gif,png,jpeg<br/>File size must not be greater then 200kb.<br />Max Width/Height:300px</span>
                        <?php echo form_upload('logo', $record['logo'], 'id="logo" class="form-control upload" placeholder='.'"'.lang('placeholder_logo').'"'."'");?>
                        <?php echo form_error('logo'); ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-upload"></i><?php echo lang('update_btn');?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php form_close(); ?>
    </div>
</div>
</div>
</div>
</div>
<!--closing div for header file-->
<script>
    $('#setlinks li').removeClass('active');
    $('#logo_li').addClass('active');
</script>