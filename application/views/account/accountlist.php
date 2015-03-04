<?php if (null!==$this->session->flashdata('message')) {
    $messageArray = $this->session->flashdata('message');
    $message = $messageArray['message'];
} ?>

                <?php if (!empty($message)): ?>
                    <div class="pad margin no-print">
                        <div class="alert alert-info" style="margin-bottom: 0!important;">
                            <i class="fa fa-info"></i>
                            <b>Note:</b> <?php echo $message;?>
                        </div>
                    </div>
                <?php endif ?>

                <div class="panel">
                    <!-- heading -->
                    <?php if (empty($accountlist)): ?>
                        <p>No Record Added Yet.</p>
                    <?php else: ?>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>    <?php echo lang('view_name_label'); ?>            </th>
                                <th>    <?php echo lang('view_status_label'); ?>    </th>
                                <th>    <?php echo lang('view_system_acc_label'); ?>    </th>
                                <th>    <?php echo lang('view_action'); ?>                </th>
                            </tr>
                            </thead>
                            <?php foreach ($accountlist as $val) : ?>
                                <tbody>
                                <tr>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo($val['status'] == '1' ? lang('view_status1_label') : lang('view_status2_label')); ?></td>
                                    <td><?php echo($val['system_acc'] == '1' ? lang('view_system_account_label') : lang('view_other_account_label')); ?></td>
                                    <td>
                                        <a <?php if ($val['system_acc'] == '1') echo 'disabled'; ?>
                                            href="<?php echo site_url('account/update') . "/" . $val['id']; ?>"
                                            class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-edit glyphicon-white"></i>
                                        </a>
                                        <a <?php if ($val['system_acc'] == '1') echo 'disabled'; ?>
                                            href="<?php echo site_url('account/delete') . "/" . $val['id']; ?>"
                                            class="delete btn btn-xs btn-danger">
                                            <i class="glyphicon glyphicon-trash glyphicon-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            <?php endforeach ?>
                        </table>
                        <nav class="pull-right">
                            <?php echo $links ?>
                        </nav>
                        <?php endif ?>
                    </div>
                </div>