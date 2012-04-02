    <style>
        .errors {
            color: red; 
        }
    </style>

<h3><?php echo $title ?></h3>

<table>
	<tr>
			<?php echo form_open('admin/newPost'); ?>
		<td>
			<?php echo form_label('Title:'); ?>
		</td>
		<td>
			<?php echo form_input('title', '', 'id="title"'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo form_label('Content:'); ?>
		</td>
		<td>
			<?php echo form_textarea('new_content', '', 'id="new_content"');?>
		</td>
	</tr>
	<tr>
		<td>
			
		</td>
		<td>
			<?php echo form_submit('submit', 'Post'); ?> 
		</td>
	</tr>
			<?php form_close() ?>
</table>

<table>
<tr>
	<td>
		<div class="errors">
				<?php echo validation_errors(); //available since using validation library ?>
		</div>
	</td>
</tr>
</table>

<script type="text/javascript">

//The prevents the submission from being entered multiple times.
var oldvalue = "";
$("form").submit(function(ev){
    var newvalue = $("title", this).val();
    if(newvalue == oldvalue) ev.preventDefault(); //Same value, cancel submission
    else oldvalue = newvalue;
})

</script>	
	
	