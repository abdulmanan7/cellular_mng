<div class="block">
	<ul id="nav">
		<li><a class="done" href="?step=checkconfig&lang=<?php echo $lang ?>"><?php echo lang('nav_check') ?></a></li>
		<li><a class="done" href="?step=database&lang=<?php echo $lang ?>"><?php echo lang('nav_db') ?></a></li>
		<li><a class="done" href="?step=user&lang=<?php echo $lang ?>"><?php echo lang('nav_settings') ?></a></a></li>
		<li><a class="done" href="?step=finish&lang=<?php echo $lang ?>"><?php echo lang('nav_end') ?></a></a></li>
	</ul>
</div>

<div class="block content">

	<h2><?php echo lang('title_finish') ?></h2>

	<p class="heading success"><?php echo lang('finish_text') ?></p>


	<div class="buttons">
		<button type="button" class="button yes right" onclick="javascript:location.href='<?php echo $base_url ?>';"><?php echo lang('button_go_to_site') ?></button>
	</div>
</div>
