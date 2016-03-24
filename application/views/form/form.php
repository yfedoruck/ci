<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if(validation_errors()) : ?>
<!--            --><?php //echo validation_errors(); ?>
        <?php endif; ?>

        <?php echo form_open('form'); ?>
            <h5>Username</h5>
            <?php echo form_error('username') ?>
            <input type="text" name="username" value="<?php echo set_value('username') ?>" size="50" />

            <h5>Password</h5>
            <?php echo form_error('password') ?>
            <input type="text" name="password" value="<?php echo set_value('password') ?>" size="50" />

            <h5>Password Confirm</h5>
            <?php echo form_error('passconf') ?>
            <input type="text" name="passconf" value="<?php echo set_value('passconf') ?>" size="50" />

            <h5>Email Address</h5>
            <?php echo form_error('email') ?>
            <input type="text" name="email" value="<?php echo set_value('email') ?>" size="50" />

            <div><input type="submit" value="Submit" /></div>

        <?php echo form_close(); ?>
    </div>
</body>
</html>