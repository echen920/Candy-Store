<h2>All Customer Orders</h2>
<?php 
		echo "<p>" . anchor('candystore/viewAdminList','Back') . "</p>";
 		echo "<p>" . anchor("candystore/delete_accounts",'Delete All Customers and Order Information',"onClick='return confirm(\"Do you really want to delete all the record?\");'") . "</p>";

		echo "<table>";
		echo "<tr><th>Order ID</th><th>Customer ID</th><th>Order Date</th><th>Order Time</th>
		<th>Total</th><th>Credit Card Number</th><th>Credit Card Month</th><th>Credit Card Year</th></tr>";
		foreach ($orders as $order) {
			echo "<tr>";
			echo "<td>" . $order->id . "</td>";
			echo "<td>" . $order->customer_id . "</td>";
			echo "<td>" . $order->order_date . "</td>";
			echo "<td>" . $order->order_time . "</td>";
			echo "<td>" . $order->total . "</td>";
			echo "<td>" . $order->creditcard_number . "</td>";
			echo "<td>" . $order->creditcard_month . "</td>";
			echo "<td>" . $order->creditcard_year . "</td>";
			
			echo "</tr>";
		}
		
		echo "</table>";

?>




