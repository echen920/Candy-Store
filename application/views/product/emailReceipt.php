<h2>Email Receipt Copy</h2>
<?php 
		echo "<table id='order'>";
		echo "<tr>Order Review</tr>";
		echo "<tr><th>Order ID</th><th>Customer ID</th><th>Order Date</th><th>Order Time</th>
		<th>Total</th><th>Credit Card Number</th><th>Credit Card Month</th><th>Credit Card Year</th></tr>";
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
		echo "</table>";
		

		echo "<table id='order_item'>";
		echo "<tr>Order Items Review</tr>";
		echo "<tr><th>Order Item ID</th><th>Order ID</th><th>Product ID</th><th>Quantity</th></tr>";

		foreach ($items as $item){
			echo "<tr>";
			echo "<td>" . $item->id . "</td>";
			echo "<td>" . $item->order_id . "</td>";
			echo "<td>" . $item->product_id . "</td>";
			echo "<td>" . $item->quantity . "</td>";
			echo "</tr>";
		}
		echo "</table>";
?>