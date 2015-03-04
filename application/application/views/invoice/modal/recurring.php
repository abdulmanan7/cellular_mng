<!-- Modal -->
<div class="modal fade" id="invoice_recurring" tabindex="-1" role="dialog" aria-labelledby="recurring_bl" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('heading_recurring'); ?></h4>
            </div>
            <div class="modal-body col-xs-12">
                <!-- <div class="container"> -->
                <p id="rec_alertmsg"></p>
                <div class="well well-sm">
                    <?php  echo form_open('invoice/recurring','class="form-horizontal " id="invoice_recurring" role="form"');  ?>
                    <input id="rec_invoice_id" name="rec_invoice_id" type="hidden">
                    <div class="form-group">
                        <label for="re_start_date" class="col-xs-12 control-label"><?php echo lang('start_date_label'); ?></label>
                        <?php echo form_input('start_date',set_value('start_date'), 'id="re_start_date" class="form-control datepicker" placeholder='.'"'.lang('placeholder_start_date').'"'."'");?>
                    </div>
                    <div class="form-group">
                        <label for="re_end_date" class="col-xs-12 control-label"><?php echo lang('end_date_label'); ?></label>
                        <?php echo form_input('end_date',set_value('end_date'), 'id="re_end_date" class="form-control datepicker" placeholder='.'"'.lang('placeholder_end_date').'"'."'");?>
                    </div>
                    <div class="form-group">
                        <label for="recurring" class="col-xs-12 control-label"><?php echo lang('recurring_label'); ?></label>
                        <?php $data = array(
                            "1" => "Daily",
                            "2" => "Weekly",
                            "3" => "monthly",
                            "4" => "Quarterly",
                            "5" => "Bi-annually",
                            "6" => "Yearly"
                        );
                        echo form_dropdown('recurring', $data, '1','class="form-control" id="recurring"');?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="sub_rec" class="btn btn-primary btn-sm"><?php echo lang('submit_btn'); ?></button>
                <?php form_close(); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#re_start_date').datepicker({
            onRender: function (date) {
                return date.valueOf() > now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date);
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('#re_end_date')[0].focus();
        }).data('datepicker');
        var checkout = $('#re_end_date').datepicker({
            onRender: function (date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function (ev) {
            checkout.hide();
        }).data('datepicker');
        $('#invoice_recurring').on('show.bs.modal', function (e) {
            var invoice_id = $(e.relatedTarget).data('id');
            $('#rec_invoice_id').val(invoice_id);

        });
            $('#sub_rec').click(function (event) {
                var invoice_id = $('#rec_invoice_id').val();
                var re_start_date = $('#re_start_date').val();
                var re_end_date = $('#re_end_date').val();
                var recurring_type = $('#recurring').find(':selected').val();
                var dataString = 'invoice_id=' + invoice_id + '&st_date=' + re_start_date + '&end_date=' + re_end_date + '&recurring_type=' + recurring_type;
                if (invoice_id == '') {
                    $('#rec_alertmsg').append('Check the Fields there may be an Input Error');
                    $('#rec_alertmsg').addClass('alert alert-danger');
                }
                else {
                    // alert(dataString);
                    // return false;
                    var url = '<?php echo site_url("invoice/add_recurring/"); ?>';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: dataString,
                        success: function () {
                            $('#rec_alertmsg').addClass('alert alert-success');
                            $('#invoice_recurring').modal('hide');
                        },
                        error: function(){
                            $('#rec_alertmsg').addClass('alert alert-danger');
                        }
                    });
                }
                // return false;
            });
        });
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
                $('#rec_alertmsg').text('');
                $('#rec_alertmsg').removeClass('alert');
                location.reload();
            });
</script>