<?php $this->view('template/header');?>
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo sprintf(lang('email_new_password_heading'), $identity); ?></h1>

                <p><?php echo sprintf(lang('email_new_password_subheading'), $new_password); ?></p>
            </div>
            <!-- Col-12 closed -->
        </div>
        <!-- Row closed -->
    </div><!-- Container closed -->
<?php $this->view('template/footer');?>