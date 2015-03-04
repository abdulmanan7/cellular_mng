<!-- Modal -->
<div class="modal fade" id="process_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('status_heading'); ?></h4>
      </div>
      <div class="modal-body col-xs-12">
        <!-- <div class="container"> -->
          <div class="row">
              <div class="col-xs-6">
                   <p id="alertppmsg"></p>
                  <div class="well well-xs">
                           <?php  echo form_open('transaction/add','class="form form-horizontal" id="process_payment_form" role="form"');  ?>
                          <fieldset>
                              <div class="form-group">
                                <label for="invoice_id" class="col-xs-4 control-label"><?php echo lang('invoice_no_label'); ?></label>
                                <div class="col-xs-8">
                                   <p class="form-control-static invoice_id"></p>
                                  <input id="invoice_id_hide" name="invoiceId" type="hidden">
                                  <input id="customer_id_hide" name="invoiceId" type="hidden">
                                </div>
                              </div><!-- Invoice ID closed -->

                             <div class="form-group col-xs-12" style="padding: 0">
                                <label for="amount" class="col-xs-4 control-label" <label for="amount" class="col-xs-4 control-label"><?php echo lang('invoice_amount_label'); ?></label>
                                <div class="col-xs-8" style="padding-left:9px">
                                   <p class="form-control-static amount"></p>
                                  <input id="amount_hide" name="invoice_amount" type="hidden">
                                </div>
                              </div><!-- Invoice amount closed -->

                               <div class="form-group">
                                <label for="paid" class="col-xs-4 control-label"><?php echo lang('paid_label'); ?></label>
                                <div class="col-xs-8">
                                   <p class="form-control-static paid"></p>
                                  <input id="paid_hide" name="invoice_paid" type="hidden">
                                </div>
                              </div><!-- Invoice paid closed -->

                               <div class="form-group">
                                <label for="invoice_received" class="col-xs-12 control-label"><?php echo lang('invoice_received_label'); ?></label>
                                <div class="col-xs-12">
                                  <input id="invoice_received" name="invoice_received" type="text" class="form-control">
                                </div>
                              </div><!-- Invoice received closed -->

                              <div class="form-group">
                                <label for="payment_method" class="col-xs-12 control-label"><?php echo lang('payment_method_label'); ?></label>
                                <div class="col-xs-12">
                                    <?php echo "<select name='payment_method' id='id_payment_method' class='form-control payment_method' >";
                                       echo "</select>";?>
                                </div>
                              </div><!-- Payment method closed -->

                              <div class="form-group">
                                  <div class="col-xs-12">
                                  <label class="control-label" for="note"><?php echo lang('invoice_note_label'); ?></label>
                                      <textarea class="form-control" id="note" name="note" placeholder="<?php echo lang('placeholder_note'); ?>" rows="4"></textarea>
                                  </div>
                              </div><!-- Invoice notes closed -->
                          </fieldset>
                      <?php form_close(); ?>
                    </div><!-- well closed -->
                      <button type="button" id="subtran" class="btn btn-primary btn-sm"><?php echo lang('status_view_submit'); ?></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div><!-- col-12 closed -->
              <div class="col-xs-6">
                <table class="table" id="payment_history_table">
                <h4 class="page-header"><?php echo lang('payment_history_heading'); ?></h4>
                   <thead>
                    <tr>
                      <th>  <?php echo lang('customer_id_label'); ?>     </th>
                      <th>  <?php echo lang('paid_label');?>  </th>
                      <th>  <?php echo lang('date_label');?> </th>
                    </tr>
                   </thead>
                  <tbody>

                  </tbody>
                  </table>
              </div><!--Table -->
        </div><!-- Row closed -->
      </div><!-- Modal body closed -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div><!-- modal content closed -->
  </div><!-- Modal dialoge closed -->
</div><!-- Modal closed -->
<script>
$(document).ready(function() {
// $(function() {
  var url='<?php echo site_url("invoice/payment_method/"); ?>';
   $.ajax({
          type: "POST",
          url: url,
          data: {},
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#id_payment_method').append('<option value="' + d.is_enable + '">' + d.name + '</option>');
              });
          }
      });

});
$('#process_payment_modal').on('show.bs.modal', function (e) {
  invoice_id = $(e.relatedTarget).data('id');
  amount = $(e.relatedTarget).data('total');
  curRight = $(e.relatedTarget).data('curright');
  curLeft = $(e.relatedTarget).data('curleft');
  cus_id = $(e.relatedTarget).data('cusid');
  paid = $(e.relatedTarget).data('paid');
  

  $('.amount').text(curLeft+amount+ " " +curRight);
  $('.paid').text(curLeft+paid+curRight);

  $('.invoice_id').text(invoice_id);
  $('#invoice_id_hide').val(invoice_id);
  $('#customer_id_hide').val(cus_id);
  $('#invoice_received').val(amount-paid);
  $('#amount_hide').val(amount);
  $('#paid_hide').val(paid);
  var url='<?php echo site_url("transaction/get_payment/"); ?>'+'/'+cus_id;
   $.ajax({
          type: "POST",
          url: url,
          data: {},
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $.each(opts, function(i, d) {
                var $tr = $('<tr>').append(
            $('<td class="text-left">').text(d.customer_id),
            $('<td class="text-left">').text(d.amount),
            $('<td class="text-left">').text(time_formatter(d.time_stamp))
        ).appendTo('#payment_history_table');
              });
          }
      });

});
$('#subtran').click(function(event) {
      var amount = $("#amount_hide").val();
      var paid = $("#paid_hide").val();
      var topay=amount-paid;
      var inv_id = $("#invoice_id_hide").val();
      var cus_id = $("#customer_id_hide").val();
      var account = $("#id_payment_method").val();
      var inv_note = $("#note").val();
      var inv_rec = $("#invoice_received").val();
      if(inv_rec=='' || inv_id=='' || cus_id=='' || account=='')
      {
        clearmsg('alertppmsg');
       $('#alertppmsg').append('Check the Fields there may be an Input Error');
       $('#alertppmsg').addClass('alert alert-danger');
      }
      else
      {
        if (inv_rec>topay) {
        clearmsg('alertppmsg');
        $('#alertppmsg').append('Received Balance is Greater then The Balance to Pay.');
        $('#alertppmsg').addClass('alert alert-danger');
        false;
        }
        else
          {
          var formdata = 'invoice_id='+ inv_id + '&company_id='+ '1' + '&customer_id=' + cus_id + '&amount=' + inv_rec + '&type=' + '1' + '&total=' + amount + '&account=' + account + '&note=' + inv_note;
          var url='<?php echo site_url("transaction/addThroughAjax"); ?>';
                $.ajax({
                  type: "POST",
                  url: url,
                  data: formdata,
                  success: function(){
                     clearmsg('alertppmsg');
                    $('#alertppmsg').append('Transaction Saved');
                     $('#alertppmsg').addClass('alert alert-success');
                      $("#note").val('');
                      $("#invoice_received").val('');
                  },
                    error:function(){
                        $('#alertppmsg').append('Transaction fail Check applied data');
                        $('#alertppmsg').addClass('alert alert-danger');
                    }
                });
          }
      }
   });

$('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        $('#alertppmsg').text('');
        $('#alertppmsg').removeClass('alert');
      });
function clearmsg(msg){
    $('#'+msg).text('');
    $('#'+msg).removeClass('alert');
}
function time_formatter(input){
    if (!input) {
    var d = new Date();
    var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var date = d.getDay() + " " + month[d.getMonth()] + ", " + d.getFullYear();
    var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date + " " + time);
    false;
    };
    var d = new Date(Date.parse(input.replace(/-/g, "/")));
    var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var date = d.getDay() + " " + month[d.getMonth()] + ", " + d.getFullYear();
    var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
     return (date + " " + time);
};
</script>