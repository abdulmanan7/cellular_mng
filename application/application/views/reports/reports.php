<?php
if (null!==$this->session->flashdata('message'))
{
    $messageArray=$this->session->flashdata('message');
    $message=$messageArray['message'];
}
array_key_exists('sum', $reports)?$sum=$reports['sum']:'';
$customer=$reports['customer'];
$currency=$reports['currency'];
unset($reports['sum']);
unset($reports['currency']);
unset($reports['customer']);
?>
<?php if(!empty($message)) {
    echo '<div class="alert alert-success">'
        .$message.'</div>';}?><!-- message -->
<section class="content custom-page">
    <div class="col-xs-12">
        <h2 class="page-header">
            <i class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"> </i><?php echo lang('heading'); ?>
        </h2>
    </div>
    <!-- /.col -->
    <div class="row content">
        <div class="box box-success">
            <div class="top-form box-header with-border">
                <form name="" method="get" action="<?php echo site_url('reports/search'); ?>" role="form" id="form" class="form-horizontal">
                    <div class="col-md-2">
                    <?php echo form_input('start_date',isset($start_date)?$start_date:'', 'id="start_date" class="form-control datepicker" placeholder='.'"'.lang('placeholder_start_date').'"'."'");?>
                </div>
                    <div class="col-md-3">
                    <?php echo form_input('end_date',isset($end_date)?$end_date:'', 'id="end_date" class="form-control datepicker" placeholder='.'"'.lang('placeholder_end_date').'"'."'");?>
                </div>
                    <div class="col-md-3">
             <?php echo "<select name='customer' class='form-control customer' >";
             echo "<option value=''>--Customer--</option>";
                    foreach ($customer as $row) {
                echo "<option value='" . $row['id'] . "'" . "data-per='" . $row['id'] . "'".(isset($cus_id)?(($row['id']==$cus_id)?"selected=selected":''):'') .">" . $row['name'] . "</option>";
                    }
                echo "</select>";?>
          </div>

                    <div class="col-md-2">
                                <?php echo "<select name='currency' id='currency' class='form-control customer' >";
                                echo "<option value=''>--All--</option>";
                                foreach ($currency as $row) {
                                    echo "<option value='" . $row['id'] . "'" . "data-symbol='" . $row['symbol_left'] . "'" . (isset($currency_id) ? (($row['id'] == $currency_id) ? "selected=selected" : '') : '') . ">" . $row['title'] . "</option>";
                                }
                                echo "</select>";?>
                            </div>

                    <div class="col-md-2">

                        <input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang('search_btn'); ?>"></button>
                    </div>
                </form>
            </div><!-- panel heading -->
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <?php if (empty($reports)): ?>
                        <p class="no-data">No Result Try Again.</p>
                    <?php else: ?>
                        <thead>
                        <tr>
                            <th>  <?php echo lang('view_serial_label'); ?>      </th>
                            <th>  <?php echo lang('view_invoice_id_label'); ?>      </th>
                            <th>  <?php echo lang('view_customer_label'); ?>      </th>
                            <th>  <?php echo lang('view_status_label');?></th>
                            <th class="text-right"> <?php echo lang('view_subtotal_label');?>    </th>
                            <th class="text-right"> <?php echo lang('view_totaltax_label');?>    </th>
                            <th class="text-right"> <?php echo lang('view_total_label');?>    </th>
                        </tr>
                        </thead><!-- table head -->
                        <?php foreach($reports as $key => $val) :?>
                            <tbody>
                            <tr>
                                <td><?php echo $key+1 ;?></td>
                                <td><?php echo $val['id'] ;?></td>
                                <td><?php echo $val['customer_name'] ;?></td>
                                <td><?php echo $val['invoice_status'] ;?></td>
                                <td><span class="pull-right"><?php echo $val['currency_symbol_left'];?><?php echo floatFormat($val['subtotal']);?></span></td>
                                <td><span class="pull-right"><?php echo $val['currency_symbol_left'];?><?php echo floatFormat($val['totaltax']);?></span></td>
                                <td><span class="pull-right"><?php echo $val['currency_symbol_left'];?><?php echo floatFormat($val['total']);?></span></td>
                            </tr>
                            </tbody>

                        <?php endforeach ?>
                    <?php endif ?>
                </table>
                <div class="row">
                    <div class="col-xs-12 txtbold"><?php echo lang('view_total_label'); ?><hr></div>
                    <div class="col-xs-6 txtbold col-sm-offset-6 col-xs-offset-5">
                        <div class="col-xs-4"><span class="curr_left"> </span> <?php echo isset($sum['subtotal'])?$sum['subtotal']:0?></div>
                        <div class="col-xs-4 col-xs-offset-1 nopadding"><span class="curr_left"> </span> <?php echo isset($sum['totaltax'])?$sum['totaltax']:0?></div>
                        <div class="col-xs-3"><span class="curr_left"> </span> <?php echo isset($sum['total'])?$sum['total']:0?></div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>
    </div>
</section>
<script>
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#start_date').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#end_date')[0].focus();
    }).data('datepicker');
    var checkout = $('#end_date').datepicker({
        onRender: function(date) {
            return date.valueOf() == checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');
    var left = $('#currency').find(':selected').data('symbol');
    ;
    $('.curr_left').html(left);
</script>