<?php if(!empty($message)) { echo '<div class="alert alert-success">' .$message; }?>
<div class="content custom-page">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header"><?php echo lang('heading_company')?></h2>
            <div class="row">
                <div class="col-md-6">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#list" data-toggle="tab"><?php echo lang('heading');?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="list">
                                <?php $this->view('company/company'); ?>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#setlinks li').removeClass('active');
    $('#company_li').addClass('active');
</script>