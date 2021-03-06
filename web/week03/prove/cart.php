<?php
	session_start();
	if(isset($_POST['remove'])) {
		$location = array_search($_POST['remove'], $_SESSION['cart']);
		array_splice($_SESSION['cart'], $location, 1);
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
			<a href="index.php">Browse</a>
			<a class="active" href="cart.php">View Cart</a>
		</div>

		<ul>
			<?php
			if((isset($_POST['unset'])) && ($_POST['unset'] == true)) {
				session_unset();
				echo "Cart is Empty";
			} elseif (!isset($_SESSION['cart'])) {
				echo "Cart is Empty";
			}

			$total = 0.00;
		
			foreach ($_SESSION['cart'] as $item) {
				switch ($item) {
					case 'Shirt':
						$pic = 'Shirt.jpg';
						$price = 7.91;
						break;
					case 'Hoodie':
						$pic = 'Hoodie.jpg';
						$price = 24.91;
						break;
					case 'Pullover':
						$pic = 'Pullover.jpg';
						$price = 23.91;
						break;
					case 'Jacket':
						$pic = 'Jacket.jpg';
						$price = 69.91;
						break;
					case 'Rugby':
						$pic = 'Rugby.jpg';
						$price = 29.91;
						break;
					case 'Jeans':
						$pic = 'Jeans.jpg';
						$price = 19.91;
						break;
				}

				$total += $price;
				echo "<li><b>$item - $".$price."</b><br><img src='$pic' class='itemPhoto2'></li>";
				echo "<form method='post' action='cart.php'>
						<button type='submit' name='remove' class='button2' value='$item'>Remove</button>
					</form>";
				echo "<br>";
			}
			echo "</ul>";
			
			echo "<b>Total: $".$total."</b>";
			?>
		</form>

		<form method="post" action="cart.php">
			<button type="submit" name="unset" value="true" class="button3">Clear Cart</button>
		</form>
		<a href="checkout.php" class="button3">Check Out</a>

	</body>
</html>