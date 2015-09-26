<h2>Customer Accounts</h2>
<?php 
		echo "<p>" . anchor('candystore/toadminList','Back') . "</p>";
 		echo "<p>" . anchor("candystore/delete_accounts",'Delete All Customers and Order Information',"onClick='return confirm(\"Do you really want to delete all the record?\");'") . "</p>";
	  
		echo "<table>";
		echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Password</th><th>Email</th></tr>";
		
		foreach ($customers as $customer) {
			echo "<tr>";
			echo "<td>" . $customer->id . "</td>";
			echo "<td>" . $customer->first . "</td>";
			echo "<td>" . $customer->last . "</td>";
			echo "<td>" . $customer->login . "</td>";
			echo "<td>" . $customer->password . "</td>";
			echo "<td>" . $customer->email . "</td>";
			

			echo "</tr>";
		}
		echo "</table>";

?>	

