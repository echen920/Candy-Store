<h2>Checkout Table</h2>

<style>
	input { display: block;}
</style>

<?php 
		echo "<p>" . anchor('candystore/shoppingCart','Back') . "</p>";
 	  
 	    echo form_open("candystore/checkOut");
		echo form_label('Username'); 
		echo form_error('username');
		echo form_input('username', set_value('username'), "required");

		echo form_label('Email Address');
		echo form_error('email');
		echo form_input('email', set_value('email'), "required");

		echo form_label('Creditcard Number');
		echo form_error('creditNum');
		echo form_input('creditNum', set_value('creditNum'), "required");

		echo form_label('Creditcard Expired Month (MM)');
		echo form_error('creditMon');
		echo form_input('creditMon', set_value('creditMon'), "required");

		echo form_label('Creditcard Expired Year (YY)');
		echo form_error('creditYr');
		echo form_input('creditYr', set_value('creditYr'), "required");
		
		echo form_submit('submit', 'Place Order');
		echo form_close();
?>

