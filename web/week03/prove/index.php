<?php
	session_start();
	if(empty($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	if(isset($_POST['item'])) {
		//echo 'Item: '.$_POST['item'];
		array_push($_SESSION['cart'], $_POST['item']);
	}
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
			<a class="active" href="index.php">Browse</a>
			<a href="cart.php">View Cart</a>
		</div>

		<div class="flex" id="itemList">
			<div class="item">
				<img src="Shirt.jpg" alt="Shirt" class="itemPhoto">
				<h4>Shirt</h4>
				<h5>Price: $7.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Shirt" class="button">Add to Cart</button>
				</form>
			</div>
			<div class="item">
				<img src="Hoodie.jpg" alt="Hoodie" class="itemPhoto">
				<h4>Hoodie</h4>
				<h5>Price: $24.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Hoodie" class="button">Add to Cart</button>
				</form>
			</div>
			<div class="item">
				<img src="Pullover.jpg" alt="Pullover" class="itemPhoto">
				<h4>Pullover</h4>
				<h5>Price: $23.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Pullover"class="button">Add to Cart</button>
				</form>
			</div>
			<div class="item">
				<img src="Jacket.jpg" alt="Jacket" class="itemPhoto">
				<h4>Jacket</h4>
				<h5>Price: $69.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Jacket" class="button">Add to Cart</button>
				</form>
			</div>
			<div class="item">
				<img src="Rugby.jpg" alt="Rugby" class="itemPhoto">
				<h4>Rugby</h4>
				<h5>Price: $29.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Rugby" class="button">Add to Cart</button>
				</form>
			</div>
			<div class="item">
				<img src="Jeans.jpg" alt="Jeans" class="itemPhoto">
				<h4>Jeans</h4>
				<h5>Price: $19.91</h5>
				<form method="post" action="index.php">
					<button type="submit" name="item" value="Jeans" class="button">Add to Cart</button>
				</form>
			</div>
		</div>
	</body>
</html>