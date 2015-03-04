<!-- Modal -->
<div class="modal fade" id="emailmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('email_title'); ?></h4>
      </div>
      <div class="modal-body col-xs-12">
        <!-- <div class="container"> -->
    <div class="row">
        <div class="col-xs-12">
            <div class="well well-sm">
                <?php echo form_open('invoice/sendemail', 'class="form-horizontal " id="emailForm" role="form"'); ?>
                    <fieldset>
                        <div class="form-group email">
                            <label class="col-xs-2 col-xs-offset-1 control-label" for="email"><?php echo lang('email_label'); ?></label>
                            <div class="col-xs-8">
                                <input id="email" name="email" type="text" <?php echo set_value();?> placeholder="Email Address" class="form-control">
                                <p id="emailError"></p>
                                <input id="emailinvoiceId" name="emailinvoiceId" type="hidden">
                                <input id="cname" name="customerName" type="hidden">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 col-xs-offset-1 control-label" for="cc"><?php echo lang('email_cc_label'); ?></label>
                            <div class="col-xs-8">
                                <input id="cc" name="cc" type="text" placeholder="Cc" class="form-control">
                            </div>
                        </div>

                        <div class="form-group subject">
                            <label class="col-xs-2 col-xs-offset-1 control-label" for="subject"><?php echo lang('email_subject_label'); ?></label>
                            <div class="col-xs-8">
                                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control">
                                <p id="subjectError"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-8 col-xs-offset-3">
                            <label class="control-label" for="message"><?php echo lang('email_message_label'); ?></label>
                                <textarea class="form-control" id="message" name="message" placeholder="<?php echo lang('placeholder_message'); ?>" rows="14"><?php echo lang('email_message_text'); ?></textarea>
                            </div>
                        </div>
                    </fieldset>
            </div><!-- well -->
        </div><!-- col-12 -->
    </div><!-- Model row -->
<!-- </div> -->
      </div><!-- Model body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-lg"><?php echo lang('email_send'); ?></button>
      <?php form_close(); ?>
      </div>
    </div><!-- Model content -->
  </div><!-- Model dialog -->
</div><!-- Model -->
<script>
$('#emailmodal').on('show.bs.modal', function (e) {
   invoice_id = $(e.relatedTarget).data('id');
   console.log(invoice_id);
    customer_email = $(e.relatedTarget).data('cemail');
   customer_name = $(e.relatedTarget).data('cname');
   $('#emailinvoiceId').val(invoice_id);
   $('#cname').val(customer_name);
   $('#email').val(customer_email);
   $('#subject').val('Invoice'+' # '+invoice_id+' '+customer_name);

});

$('#emailForm').on('submit',function (e) {
    // Get the Login Name value and trim it
    var email = $.trim($('#email').val());
    var subject = $.trim($('#subject').val());
    // Check if empty of not
    if (email  === '') {
      $('#emailError').addClass('alert alert-danger');
      $('#emailError').append('Email Required.');
      $('#email').focus();
        return false;
    }
    else{
      if( !isValidEmailAddress(email) ) {
           $('#emailError').addClass('alert alert-danger');
           $('#emailError').append('Email is not valid please provide a valid email.');
            return false;
      }
    }
    if (subject  === '') {
      $('#subjectError').addClass('alert alert-danger');
      $('#subjectError').append('Subject Required.');
      $('#subject').focus();
        return false;
    }
});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
$('#emailmodal').on('hide.bs.modal', function (e) {
  $('#subjectError').text('');
  $('#subjectError').removeClass('alert alert-danger');
  $('#emailError').text('');
  $('#emailError').removeClass('alert alert-danger');
});
</script>