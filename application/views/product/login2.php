<h2>CandyStore</h2>

<style>
	input { display: block;}
</style>

<?php 
	echo "<p>" . anchor('candystore/newAccount','Create New Account') . "</p>";
	echo form_open_multipart('candystore/viewList');
		
	echo form_label('Username'); 
	echo form_error('username');
	echo form_input('username',set_value('username'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");
?>
	
<?php 	
	
	echo form_submit('submit', 'Login');
	echo form_close();
?>	

