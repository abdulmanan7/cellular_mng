<?php $this->view('template/header');?>
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo sprintf(lang('email_forgot_password_heading'), $identity); ?></h1>

                <p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/' . $forgotten_password_code, lang('email_forgot_password_link'))); ?></p>
            </div>
            <!-- Col-12 closed -->
        </div>
        <!-- Row closed -->
    </div><!-- Container closed -->
<?php $this->view('template/footer');?>