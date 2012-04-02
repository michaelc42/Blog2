<div id="footer">

<?php if ($this->session->userdata('username')): ?>
	<p>
	You are logged in as <?php echo $this->session->userdata('username'); ?>
	 <?php echo anchor('user_control/logout', 'logout'); ?>
	 <?php echo anchor('admin/admin_panel', 'Control Panel');?>
	 </p>
	<?php else: ?>
	<p><?php echo anchor('user_control/login', 'Login'); ?> </p>
<?php endif;?>

<p>© 2011</p>

</div>

</body>

</html>
