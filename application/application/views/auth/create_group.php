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
                            class="glyphicon glyphicon-plus-sign"></span>Add New Group
                    </div>
                </div>
                <div class="box-body">
                    <div id="infoMessage"><?php echo $message; ?></div>

                    <?php echo form_open("auth/create_group"); ?>

                    <p>
                        <?php echo lang('create_group_name_label', 'group_name'); ?> <br/>
                        <?php echo form_input($group_name); ?>
                    </p>

                    <p>
                        <?php echo lang('create_group_desc_label', 'description'); ?> <br/>
                        <?php echo form_input($description); ?>
                    </p>

                    <p><?php echo form_submit('submit', lang('create_group_submit_btn'), 'class="btn btn-primary"'); ?></p>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
