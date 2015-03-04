<!DOCTYPE html>
<html class="loginPage">
<head>
    <meta charset="UTF-8">
    <title>Oinvoices | Forgot Password</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.css')?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="loginPage">
<div class="form-box" id="login-box">
    <div class="header"><?php echo lang('forgot_password_heading'); ?></div>
    <span><?php echo $message; ?></span>
    <?php echo form_open("auth/forgot_password", 'class="bootstrap-admin-login-form"'); ?>
    <div class="callout callout-info">
    <p class="">
        <?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?>
    </p>
    <?php if (!empty($message)) {
        echo '<div class="alert alert-danger">'
            . $message . '</div>';
    }
    ?>
    <p>
        <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label); ?></label>
        <br/>
        <?php echo form_input($email); ?>
    </p>

    <p> <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary"'); ?>

    <p><?php echo anchor("auth", 'Back to Login'); ?></p>
    <?php echo form_close(); ?>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>