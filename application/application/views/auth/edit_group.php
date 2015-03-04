<div class="col-md-10">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1><?php echo lang('heading'); ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($message)) {
                echo '<div class="alert alert-success">'
                    . $message . '</div>';
            }?>
            <div class="box">
                <div class="box-header with-border">
                    <div class="text-muted bootstrap-admin-box-title"><span
                            class="glyphicon glyphicon-plus-edit"></span><?php echo lang('edit_group_title'); ?></div>
                </div>
                <div class="box-body">
                    <?php echo form_open("auth/edit_group/" . $group->id, 'class="form-horizontal"'); ?>
                    <fieldset>

                        <div id="infoMessage"><?php echo $message; ?></div>

                        <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="group_name">
                                Group Name
                            </label>
                            <div class="col-lg-10">
                                <?php echo form_input($group_name); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="group_description">
                                Group Description
                            </label>
                            <div class="col-lg-10">
                                <?php echo form_input($group_description); ?>
                            </div>
                        </div>

                        <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), 'class="btn btn-primary"'); ?></p>

                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>