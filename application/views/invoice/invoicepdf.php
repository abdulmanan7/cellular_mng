<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice to PDF</title>
  <style>
  body{
    width: 100%;
    }
  h4{
    margin-top: 0;
  }
  hr {
    width: 300px;
    margin-left: auto;
    margin-right: auto;
    height: 2px;
    background-color:#f3f6db;
    color:gray;
    border: 0 none;
  }
  #tblproduct-details table { 
  color: #333;
  font-family:Arial, sans-serif;
  /*width: 1045px; */
  border-collapse:collapse;
  border-spacing: 0; 
  border-color: gray;
  }

  #tblproduct-details th { 
  border: 1px solid gray; /* No more visible border */
  height: 30px; 
    border-spacing: 0; 
  }
   #tblproduct-details td { 
  border-bottom: 1px solid gray; /* No more visible border */
  height: 30px; 
    border-spacing: 0; 
  }
  #tblproduct-details th {
  background: #DFDFDF;  /* Darken header a bit */
  font-weight: bold;
  }
    .desc{
      font-style: italic;
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
    .inv-p{
    margin-top: 20px;
    }
    #inv-spacing{
      padding-top: 0px;
    }
  </style>

</head>
<body>
<table width="100%" cellspacing="0" cellpadding="3">
  <tr>
    <td width="30%" rowspan="5"><a href="index"> <img src="/images/logo.png">Logo here </a> </td>
    <!-- logo -->
    <td><h4>Afridi PVT company Name</h4></td>
    <!-- Company Biller -->
    <td width="15%" rowspan="5"></td>
    <td width="15%" class="text-right"><h1 class="invoiceHeading">Invoice Heading here</h1></td>
  </tr>
  <tr>
    <td>Company address1</td>
  </tr>
  <tr>
    <td>CompanyEmail@email.com</td>
  </tr>
  <tr>
    <td>Company fax</td>
  </tr>
  <tr>
    <td >Company phone</td>
  </tr>
  <!-- header -->
  <tr>
    <td colspan='4'><hr></td>
  </tr>
    <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td><h4>Bill To heading</h4></td>
    <td>&nbsp;</td>
    <td><h4>Heading</h4></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      <table width="100%" cellspacing="1" cellpadding="3">
        <tr>
          <td >Customer address</td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td>Customer_email@email.com</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Customer Mobile Phone</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Customer phone</td>
          <td>&nbsp;</td>
        </tr>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
     
      </table>
      <!-- Customer Details -->    </td>
    <td colspan="2">
      <table width="100%" cellspacing="1" cellpadding="3">
        <tr>
          <td>Invoice ID</td>
          <td class="text-right">777</td>
        </tr>
        <tr>
          <td>Date: </td>
          <td class="text-right">17-feb-2014</td>
        </tr>
       <tr>
         <td>&nbsp;</td>
         <td class="text-right">&nbsp;</td>
       </tr>
        <tr>
          <td>Total</td>
          <td class="text-right"></td>
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
    <td colspan="4"><table id="tblproduct-details" cellspacing="0" width="100%" cellpadding=6>
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
      <!-- Products Details Details -->
    </table></td>
  </tr>
  <!-- Products details end -->
  <tr>
    <td></td>
    <td></td>
    <td class="text-right"><strong> <?php echo lang('sub_total_label').":"."<br>"?> <?php echo lang('tax_label').":"."<br>"?> <?php echo lang('total_label')."<br>"?> </strong> </td>
    <!-- Total Fields Heading -->
    <td class="text-right"><strong> <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['subtotal']." ".$invoice['invoice']['currency_symbol_right']; ?><br>
          <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['totaltax']." ".$invoice['invoice']['currency_symbol_right']; ?><br>
          <?php echo $invoice['invoice']['currency_symbol_left'].$invoice['invoice']['total']." ".$invoice['invoice']['currency_symbol_right']; ?><br>
    </strong> </td>
    <!-- Total Fields Details -->
  </tr>
</table>
  
<table width="100%" cellspacing="1" cellpadding="6">
  <tr>
    <td><h3><?php echo lang('heading_comments');?></h3></td>
  </tr>
  <tr>
  <?php// foreach ($invoice['status'] as $val): ?>
    <td><p><?php echo $invoice['status']['comment']; ?></p></td>
  <?php //endforeach ?>
  </tr>
</table>
</body>
</html>