<h2>Edit Account</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/viewAccounts','Back') . "</p>";
	
	echo form_open("candystore/editAccount/$customer->id");
	
	echo form_label('First Name');
	echo form_error('first');
	echo form_input('first', $cutomer->first, "required");

	echo form_label('Last Name');
	echo form_error('last');
	echo form_input('last', $customer->last, "required");

	echo form_label('Username'); 
	echo form_error('username');
	echo form_input('username',$customer->login,"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',$customer->password,"required");

	echo form_label('Email'); 
	echo form_error('email');
	echo form_input('email',$customer->email,"required");		
?>	

