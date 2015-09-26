<h2>New Account</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back') . "</p>";
	
	echo form_open_multipart('candystore/createAccount');
		
	echo form_label('First Name');
	echo form_error('first');
	echo form_input('first', set_value('first'), "required");

	echo form_label('Last Name');
	echo form_error('last');
	echo form_input('last', set_value('last'), "required");

	echo form_label('Username'); 
	echo form_error('username');
	echo form_input('username',set_value('username'),"required");

	echo form_label('Password');
	echo form_error('passwd');
	echo form_input('passwd',set_value('passwd'),"required");
	
	/*echo form_label('Confirm Password');
	echo form_error('conpasswd');
	echo form_input('conpasswd',set_value('conpasswd'),"required");*/

	echo form_label('Email'); 
	echo form_error('email');
	echo form_input('email',set_value('email'),"required");		
?>	
	
<?php 	
	
	echo form_submit('submit', 'Create');
	echo form_close();
?>	
