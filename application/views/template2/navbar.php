<header class="header">
    <a href="<?php echo base_url(); ?>" class="logo">
        Oinvoices
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?php echo ucwords($this->session->userdata['username']); ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo ucwords($this->session->userdata['username']); ?>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a class="btn btn-success" href="<?php echo site_url('auth/edit_user/') . '/' . $this->session->userdata['user_id']; ?>"><?php echo lang('nav_edit_profile'); ?></a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default" href="<?php echo site_url('auth/logout'); ?>"><?php echo lang('nav_logout'); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="glyphicon glyphicon-dashboard"></i> <?php echo lang('menu_dashboard'); ?></a></li>
            <li><a href="<?php echo site_url('invoice'); ?>"><i class="glyphicon glyphicon-list-alt"></i> <?php echo lang('menu_invoice'); ?></a></li>
            <li><a href="<?php echo site_url('customer'); ?>"><i class="glyphicon glyphicon-user"></i> <?php echo lang('menu_customer'); ?></a></li>
            <li><a href="<?php echo site_url('products'); ?>"><i class="glyphicon glyphicon-apple"></i> <?php echo lang('menu_products'); ?></a></li>
            <li><a href="<?php echo site_url('reports'); ?>"><i class="glyphicon glyphicon-duplicate"></i> <?php echo lang('menu_reports'); ?></a></li>
            <li><a href="<?php echo site_url('auth'); ?>"><i class="glyphicon glyphicon-user"></i> <?php echo lang('menu_users'); ?></a></li>
            <li class="treeview">
                <a href="<?php echo site_url('setting'); ?>">
                    <i class="glyphicon glyphicon-cog"></i> <span><?php echo lang('menu_setting'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="setlinks">
                    <li id="company_li"><a href="<?php echo site_url('setting/company'); ?>"><i class="glyphicon glyphicon-menu-right"></i> <?php echo lang('nav_company'); ?></a></li>
                    <li id="status_li"><a href="<?php echo site_url('setting/status'); ?>"><i class="glyphicon glyphicon-menu-right"></i> <?php echo lang('nav_invoice_status'); ?></a></li>
                    <li id="tax_li"><a href="<?php echo site_url('setting/tax'); ?>"><i class="glyphicon glyphicon-menu-right"></i> <?php echo lang('nav_tax_type'); ?></a></li>
                    <li id="currency_li"><a href="<?php echo site_url('setting/currency'); ?>"><i class="glyphicon glyphicon-menu-right"></i> <?php echo lang('nav_currency'); ?></a></li>
                    <li id="logo_li"><a href="<?php echo site_url('setting/changelogo'); ?>"><i class="glyphicon glyphicon-menu-right"></i> <?php echo lang('nav_logo'); ?></a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<aside class="right-side">
    <!-- Main content -->
    <section class="content">
