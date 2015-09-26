<h2>Product Table</h2>
<?php 
		echo "<p>" . anchor('candystore/shoppingCart','My Shopping Cart') . "</p>";
		echo "<p>" . anchor('candystore/logout', 'Logout') , "</p>";
 	  
		echo "<table>";
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>" . $product->price . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";

			echo "<td>" . anchor("candystore/addtoCart/$product->id",'Add to Shopping Cart') . "</td>";

			echo "</tr>";
		}
		echo "</table>";
?>	

