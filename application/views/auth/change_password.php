<?php $this->load->view('template/header');?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo form_open("auth/change_password", 'class="bootstrap-admin-login-form"'); ?>
            <h1>
                <?php echo lang('change_password_heading'); ?>
            </h1>
            <?php if (!empty($message)) {
                echo '<div class="alert alert-danger">'
                    . $message . '</div>';
            }
            ?>
            <p>
                <?php echo lang('change_password_old_password_label', 'old_password'); ?> <br/>
                <?php echo form_input($old_password); ?>
            </p>
            <p>
                <label
                    for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?>
                </label>
                <br/>
                <?php echo form_input($new_password); ?>
            </p>
            <p>
                <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm'); ?> <br/>
                <?php echo form_input($new_password_confirm); ?>
            </p>
            <?php echo form_input($user_id); ?>
            <p>
                <?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-primary"'); ?>
            </p>
            <?php echo form_close(); ?>
        </div><!-- Col-12 closed -->
    </div><!-- Row closed -->
</div><!-- Container closed -->
</body>
</html>