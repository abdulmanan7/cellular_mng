<?php
if(!empty($message))
{
    echo '<div class="alert alert-success">'.$message.'</div>';
}
?><!-- Message -->
<div class="content custom-page">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header"><?php echo lang('heading_tax')?></h2>
            <div class="row">
                <div class="col-md-6">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#list" data-toggle="tab">List</a></li>
                            <li><a href="#addnew" data-toggle="tab">Add New</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="list">
                                <?php $this->view('taxtype/taxlist'); ?>
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="addnew">
                                <?php $this->view('taxtype/addtax'); ?>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#setlinks').find('li').removeClass('active');
    $('#tax_li').addClass('active');
    $(document).ready(function() {
        $('#addform').validate(
            {
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    percentage: {
                        required: true
                    }
                }
            });
    });
</script>