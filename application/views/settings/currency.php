<?php
if(!empty($message))
{
    echo '<div class="alert alert-success">'.$message.'</div>';
}
?><!-- Message -->
<div class="custom-page">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header"><?php echo lang('heading_currency')?></h2>
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
                                <?php $this->view('currency/allcurrency'); ?>
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="addnew">
                                <?php $this->view('currency/addcurrency'); ?>
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
    $('#currency_li').addClass('active');
    $(document).ready(function () {

        $('#addform').validate(
            {
                rules: {
                    title: {
                        minlength: 2,
                        required: true
                    },
                    code: {
                        minlength: 1,
                        required: true
                    },
                    decimal: {
                        required: true,
                        number: true
                    },
                    value: {
                        required: true,
                        number: true
                    }
                }
            });
    });
</script>