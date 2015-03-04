<div class="block">

    <ul id="nav">
        <li><a class="done" href="?step=checkconfig&lang=<?php echo $lang ?>"><?php echo lang('nav_check') ?></a></li>
        <li><a class="done" href="?step=database&lang=<?php echo $lang ?>"><?php echo lang('nav_db') ?></a></li>
        <li><a class="active" href="?step=user&lang=<?php echo $lang ?>"><?php echo lang('nav_settings') ?></a></a></li>
    </ul>
</div>

<div class="block content">

    <h2 class="heading info"><?php echo lang('title_user_account') ?></h2>

    <p><?php echo lang('user_introduction') ?></p>

    <!-- User message -->
    <?php if (isset($message)) : ?>

        <p class="<?php echo $message_type ?>"><?php echo $message ?></p>

    <?php endif; ?>


    <form method="post" action="?step=user&lang=<?php echo $lang ?>">

        <input type="hidden" name="action" value="save"/>
        <dl>
            <dt>
                <label for="first_name"><?php echo lang('firstname') ?></label>
            </dt>
            <dd>
                <input name="first_name" id="firstname" type="text" class="inputtext"
                       value="<?php echo isset($first_name) ? $first_name : '' ?>"></input>
            </dd>
        </dl>

        <dl>
            <dt>
                <label for="last_name"><?php echo lang('lastname') ?></label>
            </dt>
            <dd>
                <input name="last_name" id="lastname" type="text" class="inputtext"
                       value="<?php echo isset($last_name) ? $last_name : '' ?>"></input>
            </dd>
        </dl>

        <dl>
            <dt>
                <label for="email"><?php echo lang('email') ?></label>
            </dt>
            <dd>
                <input name="email" id="email" type="text" class="inputtext" value="<?php echo $email ?>"></input>
            </dd>
        </dl>

        <dl>
            <dt>
                <label for="password"><?php echo lang('password') ?></label>
            </dt>
            <dd>
                <input name="password" id="password" type="password" class="inputtext" value=""></input>
            </dd>
        </dl>

        <dl>
            <dt>
                <label for="password2"><?php echo lang('password2') ?></label>
            </dt>
            <dd>
                <input name="password2" id="password2" type="password" class="inputtext" value=""></input>
            </dd>
        </dl>


        <?php if (!empty($encryption_key)) : ?>

            <h2><?php echo lang('encryption_key') ?></h2>

            <p><?php echo lang('encryption_key_text'); ?></p>
            <dl>
                <dt>
                    <label><?php echo lang('encryption_key') ?></label>
                </dt>
                <dd>
                    <input name="encryption_key" type="text" class="inputtext w300"
                           value="<?php echo $encryption_key ?>"></input>
                </dd>
            </dl>

        <?php endif; ?>

        <div class="buttons">
            <input type="submit" class="button yes right" value="<?php echo lang('button_save_next_step') ?>"/>
            <?php if (!empty($skip)) : ?>
                <button type="button" class="button info left"
                        onclick="javascript:location.href='?step=finish&lang=<?php echo $lang ?>';"><?php echo lang('button_skip_next_step') ?></button>
            <?php endif; ?>
        </div>
    </form>
</div>