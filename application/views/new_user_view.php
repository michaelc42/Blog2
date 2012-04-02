    <style>
        .errors {
            color: red; 
        }
    </style>

<h3><?php echo $title; ?></h3>

<table>
<?php echo form_open('user_control/new_user'); ?>
<tr>
    <td>
    <?php echo form_label('First Name:'); ?>
    </td>
    <td>
    <?php echo form_input('first_name', set_value('first_name') , 'id="first_name"'); ?>
    </td>
</tr>


<tr>
    <td>
    <?php echo form_label('Last Name:'); ?>
    </td>
    <td>
    <?php echo form_input('last_name', set_value('last_name'), 'id="last_name"'); ?>
    </td>
</tr>
<tr>
<td>
    <?php echo form_label('Username:'); ?>
    </td>
    <td>
    <?php echo form_input('username', set_value('username'), 'id="username"'); ?>
    </td>
</tr>
<tr>
    <td>
    <?php echo form_label('Email:'); ?>
    </td>
    <td>
    <?php echo form_input('email', set_value('email'), 'id="email"'); ?>
    </td>
</tr>
<tr>
    <td>
    <?php echo form_label('Password:'); ?>
    </td>
    <td>
    <?php echo form_password('password', '', 'id="password"'); ?>
    </td>
</tr>
<tr>
    <td>
    <?php echo form_label('Confirm Password:'); ?>
    </td>
    <td>
    <?php echo form_password('password2', '', 'id="password2"'); ?>
    </td>
</tr>
<tr>
<td>
<?php echo form_submit('submit', 'Create User'); ?>
</td>
</tr>
<tr>
    <td>
    </td>
    <td>
    <div class="errors">
		<?php if ( $userExists ): ?>
			<p><?php echo $userExists; ?></p>
		<?php endif; ?>	
		<?php echo validation_errors(); //available since using validation library ?>
	</div>
    </td>
</tr>
<?php form_close(); ?>

</table>
