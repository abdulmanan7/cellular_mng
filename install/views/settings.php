<div class="block">

    <ul id="nav">
        <li><a class="done" href="?step=checkconfig&lang=<?php echo $lang ?>"><?php echo lang('nav_check') ?></a></li>
        <li><a class="active" href="?step=settings&lang=<?php echo $lang ?>"><?php echo lang('nav_settings') ?></a>
        </li>
    </ul>
</div>

<div class="block content">

    <?php if (isset($message)) : ?>
        <p class="<?php echo $message_type ?>"><?php echo $message ?></p>
    <?php endif; ?>

    <form method="post" action="?step=settings&lang=<?php echo $lang ?>">

        <input type="hidden" name="action" value="save"/>

        <h2 class="heading info"><?php echo lang('settings_default_site_title') ?></h2>

        <p><?php echo lang('settings_default_site_text') ?></p>

        <!-- Default lang code -->
        <dl>
            <dt>
                <label for="base_url">Base url:</label>
            </dt>
            <dd>
                <input type="text" name="base_url" id="base_url" class="inputtext w200" value="<?= BASEURL ?>"/>
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="base_url">Site Title:</label>
            </dt>
            <dd>
                <input type="text" name="site_title" id="site_title" class="inputtext w200" value="Example.com"/>
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="default_controller">Default Controller:</label>
            </dt>
            <dd>
                <input type="text" name="default_controller" id="default_controller" class="inputtext w150"
                       value="dashboard"/>
                <p>Default controller means start page.<br>Supported Pages:<b>invoice,customer,products,reports,setting etc.</b></p>
            </dd>
        </dl>


        <!-- Admin Email -->
        <h2 class="heading info"><?php echo lang('settings_system_email_title') ?></h2>

        <p><?php echo lang('settings_admin_url_text') ?></p>
        <dl>
            <dt>
                <label for="system_email"><?php echo lang('system_email') ?></label>
            </dt>
            <dd>
                <input name="system_email" id="system_email" type="text" class="inputtext w200"
                       value="<?php echo "admin@admin.com" ?>"/>
            </dd>
        </dl>

        <div class="buttons">
            <input type="submit" class="button yes right" value="<?php echo lang('button_save_next_step') ?>"/>
        </div>

    </form>
</div>
