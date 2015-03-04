<div class="col-sm-10">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul id="setting" class="nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">
                            <?php echo lang('tab_company'); ?>
                        </a>
                    </li>
                    <li><a href="#currency" data-toggle="tab"><?php echo lang('tab_currency'); ?></a></li>
                    <li><a href="#taxtype" data-toggle="tab"><?php echo lang('tab_taxtype'); ?></a></li>
                    <li><a href="#invoice_status" data-toggle="tab"><?php echo lang('tab_status'); ?></a></li>
                    <li><a href="#account" data-toggle="tab"><?php echo lang('tab_account'); ?></a></li>
                    <li><a href="#logo" data-toggle="tab"><?php echo lang('tab_change_logo'); ?></a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <?php include('company.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="currency">
                        <?php include('currency.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="taxtype">
                        <?php include('tax.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="invoice_status">
                        <?php include('status.php'); ?>
                    </div>

                    <div class="tab-pane fade" id="account">
                        <?php include('account.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="logo">
                        <?php include('changelogo.php'); ?>
                    </div>
                </div>
                <!--Tab Content -->
            </div>
            <!-- col-sm-12-->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
<script>
    $('#setlinks li').removeClass('active');
    $('#_li').addClass('active');
</script>