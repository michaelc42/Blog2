    <style>
        .errors {
            color: red; 
        }
    </style>

<h3><?php echo $title; ?></h3>

<?php echo form_open('user_control/login', 'id="loginMain"'); ?>
<p>
<?php echo form_label('Username:'); ?>
<?php echo form_input('username', set_value('username') , 'id="username"'); ?>
</p>
<p>
<?php echo form_label('Password:'); ?>
<?php echo form_password('password', '', 'id="password"'); ?>
</p>
<?php echo form_submit('login-submit', 'Login'); ?>
<?php form_close(); ?>
<p>
<div class="errors">
	<?php if ($wrongUsername): ?>
		<p><?php echo $wrongUsername; ?></p>
	<?php endif; ?>
	<?php if($wrongPassword): ?>
		<p><?php echo $wrongPassword; ?></p>
	<?php endif; ?>
	<?php echo validation_errors(); //available since using validation library ?>
</div>
</p>
<?php echo anchor('user_control/new_user', 'Create an Account');
