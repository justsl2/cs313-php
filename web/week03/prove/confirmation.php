<?php
	session_start();
	$name = htmlspecialchars($_POST['name']);
	$address = htmlspecialchars($_POST['address']);
	$city = htmlspecialchars($_POST['city']);
	$state = htmlspecialchars($_POST['state']);
	$zip = htmlspecialchars($_POST['zip']);
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyles.css">
		<title>The Clothing Store</title>
	</head>
	<body>
		<h1>The Clothing Store</h1>
		<div class="topnav">
			<a href="index.php">Browse</a>
			<a href="cart.php">View Cart</a>
		</div>

		<h2>Confirmation Page</h2>

		<h4>Shipping to:</h4>
		<?php
			echo "$name<br>$address<br>$city, $state  $zip";
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