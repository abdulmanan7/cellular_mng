<section class="content-header">
    <h1>
        <?php echo lang('heading'); ?>
        <small>#<?php echo $invoice['invoice']['id'] ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('invoice')?>"><i class="fa fa-dashboard"></i> Invoices</a></li>
        <li class="active">View</li>
    </ol>
</section>

<!-- Main content -->
<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <a href="#"><img src="<?php echo base_url($logo); ?>"></a>
                <small class="pull-right"></small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <?php echo lang('view_bailer_details_label'); ?>
            <address>
                <strong><?php echo $invoice['invoice']['company_name'] ?></strong><br>
                <?php echo $invoice['invoice']['company_address1']; ?>
                <br>
                <?php echo $invoice['invoice']['company_email']; ?>
                <br>
                <?php echo $invoice['invoice']['company_fax']; ?>
                <br>
                <?php echo $invoice['invoice']['company_phone']; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <?php echo lang('view_receiver_details_label'); ?>
            <address>
                <strong><?php echo $invoice['invoice']['customer_name'] ?></strong><br>
                <?php echo $invoice['invoice']['customer_address']; ?>
                <br>
                <?php echo $invoice['invoice']['customer_email']; ?>
                <br>
                <?php echo $invoice['invoice']['customer_attn_name']; ?>
                <br>
                <?php echo $invoice['invoice']['customer_phone']; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b><?php echo lang('view_invoice_details_label'); ?></b><br/>
            <br/>
            <?php echo lang('invoice_no_label'); ?>
            <?php echo $invoice['invoice']['id']; ?>
            <br>
            <?php echo lang('date_label'); ?>
            <?php echo dateformat($invoice['invoice']['current_time_stamp']); ?>
            <br>
            <?php echo lang('status_view_status_label'); ?>
            <a href="#invoice_status_modal" data-toggle="modal"
               data-id="<?php echo $invoice['invoice']['id'] ?>"
               data-comment="<?php echo $invoice['status']['comment'] ?>"
               data-target="#invoice_status_modal"')><?php echo $invoice['status']['status']; ?></a>
            <br>
                <?php echo lang('total_label'); ?><small><?php echo $invoice['invoice']['currency_symbol_left']." ".$invoice['invoice']['total']; ?></small>
                <?php if ($invoice['balance']>0): ?>
                <br>
                <?php echo lang('paid_label'); ?><small><?php echo $invoice['invoice']['currency_symbol_left']." ".floatFormat($invoice['paid']); ?></small>
                <br>
                <?php echo lang('balance_label'); ?><small><?php echo $invoice['invoice']['currency_symbol_left']." ".floatFormat($invoice['balance']); ?></small>
                <?php endif ?>
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <h4><?php echo lang('product_label'); ?></h4>
                    </th>
                    <th>
                        <h4><?php echo lang('quantity_label'); ?></h4>
                    </th>
                    <th>
                        <h4><?php echo lang('price_label'); ?></h4>
                    </th>
                    <th>
                        <h4>Tax</h4>
                    </th>
                    <th>
                        <h4><?php echo lang('sub_total_label'); ?></h4>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($invoice['invoice_details'] as $key => $detailsval) {
                    echo "<tr>";
                    echo "<td>" .$detailsval['product_name']."</td>";
                    echo "<td class='text-center'>".$detailsval['quantity']."</td>";
                    echo "<td class='text-right'>".$invoice['invoice']['currency_symbol_left'].$detailsval['price']."</td>";
                    echo "<td class='text-right'>".$invoice['invoice']['currency_symbol_left'].$detailsval['product_tax']."</td>";
                    echo "<td class='text-right'>".$invoice['invoice']['currency_symbol_left'].$detailsval['product_total']."</td>";
                    echo "</tr>";
                    echo "<tr>";if (!empty($detailsval['product_description'])) {
                        echo "<td colspan='5' class='active'>" .$detailsval['product_description']."</td></tr>";
                    }

                } ?>
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">

        <div class="col-xs-12">
            <!--                             <p class="lead">Amount Due 2/22/2014</p> -->
            <div class="table-responsive pull-right">
                <table class="table">
                    <tr>
                        <th style="width:50%"><?php echo lang('sub_total_label');?></th>
                        <td><?php echo $invoice['invoice']['currency_symbol_left'] . $invoice['invoice']['subtotal'] . " " . $invoice['invoice']['currency_symbol_right']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('tax_label'); ?></th>
                        <td><?php echo $invoice['invoice']['currency_symbol_left'] . $invoice['invoice']['totaltax'] . " " . $invoice['invoice']['currency_symbol_right']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('total_label'); ?></th>
                        <td><?php echo $invoice['invoice']['currency_symbol_left'] . $invoice['invoice']['total'] . " " . $invoice['invoice']['currency_symbol_right']; ?></td>
                    </tr>

                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
            <a href="#emailmodal" class="btninv_st btn btn-success pull-right" data-toggle="modal"
                                                          data-id="<?php echo $invoice['invoice']["id"] ?>"
                                                          data-cemail="<?php echo $invoice['invoice']["customer_email"] ?>"
                                                          data-cname="<?php echo $invoice['invoice']["customer_name"] ?>"
                                                          data-target="#emailmodal"><i class=""></i> <?php echo lang('send_as_email_btn'); ?></a>
            <a href="#process_payment_modal" class="btn bg-purple" data-toggle="modal" data-id="<?php echo $invoice['invoice']['id'] ?>"
               data-cusid="<?php echo $invoice['invoice']['customer_id'] ?>" data-total="<?php echo $invoice['invoice']['total'] ?>"
               data-bal="<?php echo $invoice['balance'] ?>" data-paid="<?php echo $invoice['paid'] ?>"
               data-curLeft="<?php echo $invoice['invoice']['currency_symbol_left'] ?>" data-curRight="<?php echo $invoice['invoice']['currency_symbol_right'] ?>"
               data-target="#process_payment_modal") data-original-title="Process Payment">
            <i class="fa fa-credit-card"></i><?php echo lang('process_payment') ?></a>
            <a href="<?php echo site_url('invoice/getpdf')."/".$invoice['invoice']['id']; ?>" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
        </div>
    </div>
</section><!-- /.content -->
<?php $this->load->view('invoice/modal/email');?>
<?php $this->load->view('invoice/modal/invoice_status');?>
<?php $this->load->view('invoice/modal/recurring');?>
<?php $this->load->view('invoice/modal/process_payment');?>