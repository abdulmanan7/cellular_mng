<!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-info">
  <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
  <?php echo lang('view_action');?>
  </button>
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

    <li><?php echo anchor("customer/update/".$key->id,lang('edit_btn')) ;?></li>
    <li class="divider"></li>
    <li> <?php echo anchor("customer/delete/".$key->id,lang('del_btn')) ;?></li>

  </ul>
</div>