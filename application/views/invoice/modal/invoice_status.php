<!-- Modal -->
<div class="modal fade" id="invoice_status_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('status_heading'); ?></h4>
      </div>
      <div class="modal-body col-xs-12">
        <!-- <div class="container"> -->
    <div class="row">
        <div class="col-lg-6 col-xs-12">
                              <p id="alertstmsg"></p>
            <div class="well well-sm">
                     <?php  echo form_open('invoice/sendinvoice_status','class="form-horizontal " id="invoice_statusForm" role="form"');  ?>
                    <fieldset>
                        <div class="form-group">
                          <label for="invoice_status" class="col-xs-12 control-label"><?php echo lang('status_view_status_label'); ?></label>
                          <div class="col-xs-12">
                              <?php echo "<select name='invoice_status' id='id_invoice_status' class='form-control invoice_status' >";
                              echo "</select>";?>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label class="control-label" for="comments"><?php echo lang('status_view_comment_label'); ?></label>
                                <textarea class="form-control" id="comment" name="comment" placeholder="<?php echo lang('status_placeholder_comments'); ?>" rows="14"><?php echo lang('status_comment'); ?></textarea>
                            </div>
                            <input id="invoice_id_hide" name="invoiceId" type="hidden">
                        </div>
                    </fieldset>
              </div><!-- Well -->
                <button type="button" id="sub" class="btn btn-primary btn-sm"><?php echo lang('status_view_submit'); ?></button>
                <?php form_close(); ?>
        </div><!-- Model Form Fields -->
        <div class="col-lg-6 col-xs-12">
                  <table class="table" id="status_table">
                   <thead>
                    <tr>
                      <th>  <?php echo lang('status_view_time_label'); ?>     </th>
                      <th>  <?php echo lang('status_view_status_label');?>  </th>
                      <th>  <?php echo lang('status_view_comment_label');?> </th>
                    </tr>
                   </thead>
                  <tbody>

                  </tbody>
                  </table>
        </div><!-- Table div -->
    </div><!-- Model row -->
<!-- </div> -->
      </div><!-- Model body -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div><!-- Model content -->
  </div><!-- Model dialog -->
</div><!-- Model -->
<script>
    $(document).ready(function () {
// $(function() {
  var url='<?php echo site_url("invoice/getstatusjson/"); ?>';
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
                  $('#id_invoice_status').append('<option value="' + d.id + '">' + d.name + '</option>');
              });
          }
      });
});
$('#invoice_status_modal').on('show.bs.modal', function (e) {
  invoice_id = $(e.relatedTarget).data('id');
  comment = $(e.relatedTarget).data('comment');
  $('#comment').val(comment);
  $('#invoice_id_hide').val(invoice_id);
  var url='<?php echo site_url("invoice/get_inv_st_json/"); ?>'+'/'+invoice_id;
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
            $('<td class="text-left">').text(time_formatter(d.time_stamp)),
            // $('<td class="text-left">').text(d.time_stamp),
            $('<td class="text-left">').text(d.name),
            $('<td class="text-left">').text(d.comment)
        ).appendTo('#status_table');
              });
          }
      });
});
$('#sub').click(function(event) {
      var statusesId = $("#id_invoice_status").val();
      var comment = $("#comment").val();
      var invoice_id = $("#invoice_id_hide").val();
      var dataString = 'invoice_id='+ invoice_id + '&invoice_statuses_id=' + statusesId + '&comment=' + comment;
      if(statusesId=='' || invoice_id=='')
      {
        $('#alertstmsg').append('Check the Fields there may be an Input Error');
       $('#alertstmsg').addClass('alert alert-danger');
      }
      else
      {
        // alert(dataString);
        // return false;
          var url = '<?php echo site_url("invoice/add_invoice_status_detail/"); ?>';
            $.ajax({
              type: "POST",
              url: url,
              data: dataString,
              success: function(){
                $('#alertstmsg').append('Status Saved');
                 $('#alertstmsg').addClass('alert alert-success');
                $('#comment').val('');
                  // $.ready();
                 var $tr = $('<tr>').append(
            $('<td class="text-left">').text(time_formatter()),
            // $('<td class="text-left">').text(time_formatter((new Date).getTime())),
            $('<td class="text-left">').text($("#id_invoice_status :selected").text()),
            $('<td class="text-left">').text(comment)
            ).appendTo('#status_table');
              }
            });
      }
      // return false;
   });
 $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        $("#status_table tbody tr").remove();
        $('#alertstmsg').text('');
        $('#alertstmsg').removeClass('alert');
     location.reload();
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