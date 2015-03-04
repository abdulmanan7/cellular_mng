<?php if (!empty($message)) {
    echo '<div class="alert alert-success">'
        . $message . '</div>';
}?>
<div class="box box-primary">
    <?php echo form_open('currency/add', 'class="form-horizontal" id="addform" role="form"'); ?>
    <div class="box-body">
        <div class="form-group">
            <label for="title"
                   class="control-label sr_only col-md-3"><?php echo lang('title_label'); ?></label>
            <div class="col-md-7">
                <?php echo form_input('title', set_value('title'), 'id="title" class="form-control"' . 'placeholder=' . '"' . lang('placeholder_title') . '"' . "'"); ?>
                <span class="help-block error"><?php echo form_error('title'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="code"
                   class="control-label sr_only col-md-3"><?php echo lang('code_label'); ?></label>

            <div class="col-md-7">
                <?php echo form_input('code', set_value('code'), 'id="code" class="form-control" id="code"' . 'placeholder=' . '"' . lang('placeholder_code') . '"' . "'"); ?>
                <span class="help-block error"><?php echo form_error('code'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="symbol_left"
                   class="control-label sr_only col-md-3"><?php echo lang('symbol_left_label'); ?></label>

            <div class="col-md-7">
                            <?php echo form_input('symbol_left', set_value('symbol_left'), 'id="symbol_left" class="form-control"' . 'placeholder=' . '"' . lang('placeholder_symbol_left') . '"' . "'"); ?>
                        </div>
        </div>
        <div class="form-group">
            <label for="symbol_right"
                   class="control-label sr_only col-md-3"><?php echo lang('symbol_right_label'); ?></label>

            <div class="col-md-7">
                            <?php echo form_input('symbol_right', set_value('symbol_right'), 'id="symbol_right" class="form-control"' . 'placeholder=' . '"' . lang('placeholder_symbol_right') . '"' . "'"); ?>
                        </div>
        </div>
        <div class="form-group">
            <label for="decimal_place"
                   class="control-label sr_only col-md-3"><?php echo lang('decimal_place_label'); ?></label>

            <div class="col-md-7">
                <?php echo form_input('decimal_place', set_value('decimal_place'), 'id="decimal_place" class="form-control"' . 'placeholder=' . '"' . lang('placeholder_decimal_place') . '"' . "'"); ?>
                <span class="help-block error"><?php echo form_error('decimal_place'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="value"
                   class="control-label sr_only col-md-3"><?php echo lang('value_label'); ?></label>

            <div class="col-md-7">
                <?php echo form_input('value', set_value('value'), 'id="value" class="form-control"' . 'placeholder=' . '"' . lang('placeholder_value') . '"' . "'"); ?>
                <span class="help-block error"><?php echo form_error('value'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="status"
                   class="control-label sr_only col-md-3"><?php echo lang('status_label'); ?></label>

            <div class="col-md-7">
                            <?php
                            $options = array(
                                '1' => lang('view_status1_label'),
                                '2' => lang('view_status2_label'),
                            );
                            echo form_dropdown('status', $options, '1', 'class="form-control selectize-select"' . 'placeholder=' . '"' . lang('placeholder_status') . '"' . "'");
                            ?>
                        </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit"
                class="col-md-offset-3 btn btn-primary"><?php echo lang('create_btn'); ?></button>
    </div>
    <?php form_close(); ?><!-- Form closed -->
</div>
<script>


</script>