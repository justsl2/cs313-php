<?php
	session_start();

	//var_dump($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyles.css">
	<title>Checkout</title>
</head>
<body>
	<h1>Clothing Store</h1>
	<div class="topnav">
		<a href="index.php">Browse</a>
		<a href="cart.php">View Cart</a>
	</div>

	<form id="userInfo" method="post" action="confirmation.php">
		<label>Name:</label> <input type="text" name="name"><br>
		<label>Address 1:</label>  <input type="text" name="address1"><br>
		<label>Address 2:</label>  <input type="text" name="address2"><br>
		<label>City:</label>       <input type="text" name="city"><br>
		<label>State:</label>      <input type="text" name="state"><br>
		<label>Zip:</label>        <input type="text" name="zip"><br>
		<button type="submit" id="confirmOrder" class="button">Submit Order</button>
	</form>
</body>
</html>