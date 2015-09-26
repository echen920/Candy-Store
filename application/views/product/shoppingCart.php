<h2>Your Shopping Cart</h2>
<?php 
		echo validation_errors();
		echo "<p>" . anchor('candystore/toList','Back') . "</p>";
		echo "<p>" . anchor('candystore/checkOut_view', 'CheckOut') . "</p>";
 	  
		echo "<table>";
		echo "<tr><th>Photo</th></th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th></tr>";
		
		foreach ($order_items as $order_item) {
			echo "<tr>";
			echo "<td><img src='" . base_url() . "images/product/" . $order_item->photo_url . "' width='100px' /></td>";
			echo "<td>" . $order_item->name . "</td>";
			echo "<td>" . $order_item->description . "</td>";
			echo "<td>" . $order_item->price . "</td>";
			echo "<td>" . $order_item->quantity . "</td>";

			echo "<td>";
			echo form_open_multipart('candystore/change_quantity');
			echo form_hidden('id', $order_item->product_id);
			echo form_error('quantity');
			echo form_input('quantity',set_value('quantity'),"required");

			echo form_submit('submit', 'Change Qauntity');
			echo form_close();
			echo "</td>";
			//echo "<td>" . anchor("candystore/change_quantity/$order_item->id",'Change Quantity') . "</td>";
			echo "<td>" . anchor("candystore/delete_cart/$order_item->product_id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";

			echo "</tr>";
		}
		echo "</table>";
		echo "<p> Total: $" . $total . "</p>";
?>	

