<?php
	session_start();
	$name = htmlspecialchars($_POST['name']);
	$address1 = htmlspecialchars($_POST['address1']);
	$address2 = htmlspecialchars($_POST['address2']);
	$city = htmlspecialchars($_POST['city']);
	$state = htmlspecialchars($_POST['state']);
	$zip = htmlspecialchars($_POST['zip']);

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyles.css">
	<title>Order Confirmation</title>
</head>
<body>
	<h1>Clothing Store</h1>
	<div class="topnav">
		<a href="index.php">Browse</a>
		<a href="cart.php">View Cart</a>
	</div>

	<h2>Confirmation Page</h2>

	<h4>Shipping to:</h4>
	<?php
		echo "$name<br>$address1 $address2<br>$city, $state  $zip";
	?>

	<h4>Purchased Items:</h4>
	<ul>
	<?php
		foreach ($_SESSION['cart'] as $item) {
			echo "<li>$item</li>";
		}
		echo "</ul>";
	?>

</body>
</html>