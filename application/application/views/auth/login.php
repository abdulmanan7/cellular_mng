<!DOCTYPE html>
<html class="loginPage">
    <head>
        <meta charset="UTF-8">
        <title>Oinvoices | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('_assets/css/AdminLTE.css')?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="loginPage">
<div class="form-box" id="login-box">
    <div class="header"><?php echo lang('login_heading'); ?></div>

    <?php echo form_open("auth/login", 'class="bootstrap-admin-login-form"'); ?>
    <div class="body bg-gray">
        <span class="help-block"><?php echo (isset($message))?$message:'Enter Login details to sign in'; ?></span>
        <div class="form-group">
            <?php echo form_input($identity); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($password); ?>
        </div>
        <div class="form-group">
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> <?php echo lang('login_remember_label'); ?>
        </div>
    </div>
    <div class="footer">
        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-lg btn-primary"'); ?>

        <p class="text-center"><a href="<?php echo site_url('auth/forgot_password'); ?>">
                <?php echo lang('login_forgot_password'); ?></a>
        </p>


    </div>
    <?php echo form_close();?>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>