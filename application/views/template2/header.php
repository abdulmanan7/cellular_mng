<!DOCTYPE html>
<html>
    <head>
        <title>Oinvoices | Admin</title>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	    <!-- Bootstrap 3.3.2 -->
        <!--Jquery -->
        <script src="<?php echo base_url('assets/js/jQuery-2.1.3.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>

        <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
	    <!-- Font Awesome Icons -->
	    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
	    <!-- Ionicons -->
	    <link href="<?php echo base_url('assets/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />

	    <?php /*
	    <!-- Morris chart -->
	    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	    <!-- jvectormap -->
	    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	    <!-- Daterange picker -->
	    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	    */ ?>
        <!-- Theme style -->
	    <!-- AdminLTE Skins. Choose a skin from the css/skins
	         folder instead of downloading all of them to reduce the load. -->

        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>">
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/css/core-b3.css'); ?>">
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/vendors/bootstrap-datepicker/css/datepicker.css'); ?>">
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/css/datepicker.fixes.css'); ?>">

        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.3 -->


<!--        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php echo base_url('assets/jquery-ui-bootstrap/assets/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

	    <![endif]-->


        <?php $this->lang->load('common'); ?>

    </head>
    <body class="skin-blue" <?php echo (isset($pageName))?'id='.$pageName: ''; ?>>