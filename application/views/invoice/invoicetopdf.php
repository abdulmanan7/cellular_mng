<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<title><?php echo lang('heading_pdf'); ?></title>
    <style>
        body{
            width: 700px;
            font-family: arial, sans-serif;
            font-size: 13px;
        }

        h3 {
            margin-top: 0;
            color: #008af5;
        }
        h4{
            margin-top: 0;
        }

        .heading {
            border: 2px;
            border-bottom-style: solid;
            border-bottom-color: #80e3ff;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            right: 10px;
            text-align: right;
            font-size: 9px;
            color: darkgrey;
        }

        .company {
            color: #008af5;
        }
        hr {
            width: 600px;
            margin-left: auto;
            margin-right: auto;
            height: 2px;
            background-color: #3d3d3d;
            color:gray;
            border: 0 none;
        }
        #tblproduct-details table {
            font-family:Arial, sans-serif;
            border-collapse:collapse;
            border-spacing: 0;
            border-color: #DFDFDF;
        }

        #tblproduct-details th {
            background: #DFDFDF;
            border: 2px solid #ffffff; /* No more visible border */
            border-bottom-color: #80e3ff;
            height: 10px;
            border-spacing: 0;
        }
        #tblproduct-details td {

            border-bottom: 1px solid #b7b8b5; /* No more visible border */
            height: 30px;
            border-spacing: 0;
        }

        /*#tblproduct-details th {*/
        /*font-weight: bold;*/
        /*}*/
        .desc{
            font-style: italic;
            font-size: 12px;
            font-family: "verdana", "sans-serif";
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .inv-p p{
            display: inline-block;
            text-align: right;
            padding: 0;
            margin: 0;
        }

    </style>
</head>
<body>
<table width="700px" cellspacing="1" cellpadding="6">
    <tr>
        <td width="275px"><a href="#"> <img src="<?php echo base_url($logo); ?>"> </a></td>
        <!-- logo -->
        <td width="275px"><h4> <?php echo $invoice['invoice']['company_name']?></h4>
            <p> <?php echo $invoice['invoice']['company_address1']; ?> <br/>
                <?php echo $invoice['invoice']['company_email']; ?> <br/>
                <?php echo $invoice['invoice']['company_fax']; ?> <br/>
                <?php echo $invoice['invoice']['company_phone']; ?> </p></td>
        <!-- Company Biller -->
        <td width="120px" class="text-right"><h1 class="invoiceHeading"><?php echo lang('heading');?></h1></td>
        <td width="30px"></td>
    </tr>
    <!-- header -->
</table>
<table id="head-hr" width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td colspan='4'>&nbsp;</td>
    </tr>
    <tr>
        <td colspan='4'>&nbsp;</td>
    </tr>
</table>
<table id="bill-rec-headers" width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td width="51%" class="heading"><h3><?php echo lang('view_receiver_details_label'); ?></h3></td>
        <td width="22%">&nbsp;</td>
        <td width="25%" class="heading"><h3><?php echo lang('view_invoice_details_label'); ?></h3></td>
        <td width="2%">&nbsp;</td>
    </tr>
</table>
<table id="details" width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td colspan="2">
            <table width="100%" cellspacing="1" cellpadding="3">
                <tr>
                    <td width="70%"><?php echo $invoice['invoice']['customer_address']; ?></td>
                    <td width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo $invoice['invoice']['customer_email']; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo $invoice['invoice']['customer_attn_name']; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo $invoice['invoice']['customer_phone']; ?></td>
                    <td>&nbsp;</td>
                </tr>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php if ($invoice['balance']>0): ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        <?php endif ?>
            </table>
            <!-- Customer Details -->
        </td>
        <td width="27%" colspan="2">
            <table width="100%" cellspacing="1" cellpadding="3">
                <tr>
                    <td><?php echo lang('invoice_no_label'); ?></td>
                    <td class="text-right"><?php echo $invoice['invoice']['id']; ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('date_label'); ?>: </td>
                    <td class="text-right"><?php echo dateformat($invoice['invoice']['current_time_stamp']); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="text-right">&nbsp;</td>
                </tr>
                <tr>
                    <td width="40%"><?php echo lang('total_label'); ?></td>
                    <td width="60%" class="text-right">
                        <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['total']." ".$invoice['invoice']['currency_symbol_right']; ?></td>
                </tr>
        <tr>
          <td><?php echo lang('paid_label'); ?></td>
          <td class="text-right"><?php echo $invoice['invoice']['currency_symbol_left'].floatFormat($invoice['paid'])." ".$invoice['invoice']['currency_symbol_right']; ?></td>
        </tr>
         <?php if ($invoice['balance']>0): ?>
        <tr>
          <td ><?php echo lang('balance_label'); ?></td>
          <td class="text-right"><?php echo $invoice['invoice']['currency_symbol_left'].floatFormat($invoice['balance'])." ".$invoice['invoice']['currency_symbol_right']; ?></td>
        </tr>
          <?php endif ?>
      </table>    </td>
        <!-- Bailer and recever -->
    </tr>
    <tr>
        <td colspan="4">
            <table id="tblproduct-details" cellspacing="0" width="100%" cellpadding="6">
                <tr>
                    <th> <h4><?php echo lang('product_label'); ?></h4></th>
                    <th> <h4><?php echo lang('quantity_label'); ?></h4></th>
                    <th> <h4><?php echo lang('price_label'); ?></h4></th>
                    <th> <h4><?php echo lang('tax_label'); ?></h4></th>
                    <th> <h4><?php echo lang('sub_total_label'); ?></h4></th>
                </tr>
                <!-- Products Heading -->
                <?php foreach ($invoice['invoice_details'] as $key => $detailsval) {
                    echo "<tr>";
                    echo "<td>" .$detailsval['product_name']."</td>";
                    echo "<td class='text-center'>".$detailsval['quantity']."</td>";
                    echo '<td class="text-right">'.$invoice['invoice']['currency_symbol_left'].$detailsval['price']."</td>";
                    echo "<td class='text-right'>".$invoice['invoice']['currency_symbol_left'].$detailsval['product_tax']."</td>";
                    echo "<td class='text-right'>".$invoice['invoice']['currency_symbol_left'].$detailsval['product_total']."</td>";
                    echo "</tr>";
                    if (!empty($detailsval['product_description'])) {
                        echo "<tr><td colspan='5' class='active desc'>" .$detailsval['product_description']."</td></tr>";
                    }
                } ?>
            </table>
        </td>
    </tr>
    <!-- Products Details Details -->
</table>
<!-- Products details end -->
<table id="invoice_total" width="100%" cellspacing="1" cellpadding="6">
    <tr>
        <td width="77%" class="text-right">
            <strong> <?php echo lang('sub_total_label') . ":" . "<br>" ?> <?php echo lang('tax_label') . ":" . "<br>" ?> <?php echo lang('total_label') . "<br>" ?> </strong>
        </td>
        <!-- Total Fields Heading -->
        <td width="23%" class="text-right">
            <strong> <?php echo $invoice['invoice']['currency_symbol_left'] . $invoice['invoice']['subtotal'] . " " . $invoice['invoice']['currency_symbol_right']; ?>
                <br>
                <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['totaltax']." ".$invoice['invoice']['currency_symbol_right']; ?><br>
                <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['total']." ".$invoice['invoice']['currency_symbol_right']; ?><br>
            </strong> </td>
        <!-- Total Fields Details -->
    </tr>
    <tr>
        <td class="heading" colspan="2"><h3><?php echo lang('heading_note'); ?></h3></td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $company['footer_notes']; ?></td>
    </tr>
</table>
</body>
</html>