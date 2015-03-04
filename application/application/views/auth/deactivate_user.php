<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
?>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header with-border">
                <div class="text-muted bootstrap-admin-box-title"><span
                        class="glyphicon glyphicon-plus-ban-circle"></span><?php echo lang('deactivate_heading'); ?>
                </div>
            </div>
            <div class="box-body">
                <?php echo form_open("auth/deactivate/" . $user->id); ?>
                <p>
                    <?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
                    <input type="radio" name="confirm" value="yes" checked="checked"/>
                    <?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
                    <input type="radio" name="confirm" value="no"/>
                </p>

                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden(array('id' => $user->id)); ?>

                <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="btn btn-primary"'); ?></p>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php $this->load->view('template/footer'); ?>