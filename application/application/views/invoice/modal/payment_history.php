<!-- Modal -->
<div class="modal fade" id="payment_history_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('payment_history_heading'); ?></h4>
      </div>
      <div class="modal-body col-xs-12">
                              <p id="alert_pay_his"></p>
                  <table class="table" id="payment_history_table">
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
      </div><!-- Model body -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div><!-- Model content -->
  </div><!-- Model dialog -->
</div><!-- Model -->
<script>
    $(document).ready(function () {

});
$('#invoice_status_modal').on('show.bs.modal', function (e) {
  cus_id = $(e.relatedTarget).data('cus_id');
  var url='<?php echo site_url("invoice/get_payment/"); ?>'+'/'+cus_id;
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
            $('<td class="text-left">').text(d.amount)
            $('<td class="text-left">').text(time_formatter(d.time_stamp)),
        ).appendTo('#payment_history_table');
              });
          }
      });
});
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