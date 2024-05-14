<?php
require_once "pdo.php";
session_start();
// Function to add item to cart
function addToCart($item_name, $item_price, $item_image, $pdo) {
// Insert item into database
    $sql = "INSERT INTO cart_items (item_name, item_price, item_image) VALUES (:item_name, :item_price, :item_image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':item_name' => $item_name, ':item_price' => $item_price , ':item_image' => $item_image));
// Retrieve the last inserted ID
    $item_id = $pdo->lastInsertId();
// Add the item to the session cart variable
    $item = array(
        'id' => $item_id,
        'name' => $item_name,
        'price' => $item_price,
		'image' => $item_image
    );
    $_SESSION['cart'][] = $item;
}
// Add item to cart if 'add_to_cart' is set in POST
if (isset($_POST['add_to_cart'])) {
	$item_name = $_POST['item_name']; // Get item name from form
    $item_price = $_POST['item_price']; // Get item price from form
	$item_image = $_POST['item_image']; // Get item image from form
    addToCart($item_name, $item_price,$item_image, $pdo);
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect to prevent form resubmission
    exit();
}
// Delete item from cart if 'delete_item' is set in POST
if (isset($_POST['delete_item'])) {
    $item_index = $_POST['item_index'];
    $item_id = $_SESSION['cart'][$item_index]['id'];   
    // Delete item from database
    $sql = "DELETE FROM cart_items WHERE item_id = :item_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':item_id' => $item_id));
	
    // Remove item from session cart variable
    unset($_SESSION['cart'][$item_index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the session cart array
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect back to the page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<title>
            Home
	</title>
	<link rel="stylesheet" type="text/css" href="text.css">
</head>
<body>
	<a class="skip-link" href="#main-content">
		Skip to main content
	</a>
	<header>
		<img class="logo" src="img/logo.png" alt="logo">
		<h1>USN Dietary Supplement</h1>
		<nav>
			<ul class="pages">
				<li><span class='material-icons'></span><a href="Index.php">Home</a></li>
				<li><a href="contactus.php">Contact us</a></li>
				<li><a href="MemberArea.php">Member Area</a></li>
				<li><a href="admin.php">Admin</a></li>				
			</ul>
		</nav>	
	</header>
	<main id=“main-content”>
		<form method="get" action="search.php">
		<label for="search_query">Search for products:</label>
    		<input type="text"id="search_query" name="search_query" placeholder="Search for products" required>
    		<button type="submit">Search</button>
		</form>
		<div id="product-list" class="products">
			<h3 class=" best-sellers">Best sellers</h3>
			<div class="product-list-container">
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/DietFuel.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Diet Fuel Protein</h4>
					<!--text-->
					<span class="price">&pound;36.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Diet Fuel Protein">
                        <input type="hidden" name="item_price" value="36.99">
						<input type="hidden" name="item_image" value="img/Diet Fuel.png">
						<button type="submit">Add to Cart</button>
					</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/protein2.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Whey-Protein-Isolate</h4>
					<!--text-->
					<span class="price">&pound;22.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Whey-Protein-Isolate">
                        <input type="hidden" name="item_price" value="22.99">
						<input type="hidden" name="item_image" value="img/protein2.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a  class="product-img">
					<img src="img/protein4.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Whey Protein-Hardcore</h4>
					<!--text-->
					<span class="price">&pound;34.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Whey Protein-Hardcore">
                        <input type="hidden" name="item_price" value="34.99">
						<input type="hidden" name="item_image" value="img/protein4.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a  class="product-img">
					<img src="img/protein5.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Muscle Fuel</h4>
					<!--text-->
					<span class="price">&pound;49.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Muscle Fuel">
                        <input type="hidden" name="item_price" value="49.99">
						<input type="hidden" name="item_image" value="img/protein5.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a  class="product-img">
					<img src="img/protein6.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Muscle Fuel- Big siz</h4>
					<!--text-->
					<span class="price">&pound;45.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Muscle Fuel- Big siz">
                        <input type="hidden" name="item_price" value="45.99">
						<input type="hidden" name="item_image" value="img/protein6.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/protein7.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Plant Protein</h4>
					<!--text-->
					<span class="price">&pound;33.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Plant Protein">
                        <input type="hidden" name="item_price" value="33.99">
						<input type="hidden" name="item_image" value="img/protein7.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/protein8.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Protein Bar</h4>
					<!--text-->
					<span class="price">&pound;27.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Protein Bar">
                        <input type="hidden" name="item_price" value="27.99">
						<input type="hidden" name="item_image" value="img/protein8.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/protein9.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">ISO GRO Protein</h4>
					<!--text-->
					<span class="price">&pound;69.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="ISO GRO Protein">
                        <input type="hidden" name="item_price" value="69.99">
						<input type="hidden" name="item_image" value="img/protein9.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/proteinqqq.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Casein</h4>
					<!--text-->
					<span class="price">&pound;54.99</span>
					<!--price-->
					<form method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Casein">
                        <input type="hidden" name="item_price" value="54.99">
						<input type="hidden" name="item_image" value="img/proteinqqq.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
			<section class="product-box">
				<h2>SALE</h2>
				<a class="product-img">
					<img src="img/protein1.png" alt="USN whey-protein-isolate">
					<!--img-->
				</a>
				<div class="product-text">
					<h4 class="product-name">Diet Fuel Protein</h4>
					<!--text-->
					<span class="price">&pound;39.99</span>
					<!--price-->
					<form class="cart1" method="post">
						<input type="hidden" name="add_to_cart">
						<input type="hidden" name="item_name" value="Diet Fuel Protein">
                        <input type="hidden" name="item_price" value="39.99">
						<input type="hidden" name="item_image" value="img/protein1.png">
						<button type="submit">Add to Cart</button>
				</form>
				</div>
			</section>
		</div>
	</div>
	<div class="shopping-cart">
    <h2>Shopping Cart</h2>
    <?php 
	$total_price = 0; // Initialize total price
	if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <?php foreach($_SESSION['cart'] as $index => $cart_item): ?>
            <div class="cart-item">
                <div class="item-details">
					<div class="item-image">
						<img src="<?php echo $cart_item['image']; ?>" alt="<?php echo $cart_item['name']; ?>">
					</div>
					<div class="item-info">	
                    	<h3><?php echo $cart_item['name']; ?></h3>
                    	<h4>Price: &pound;<?php echo $cart_item['price']; ?></h4>
					</div>
                </div>
                <form method="post" class="remove-form">
                    <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                    <input type="hidden" name="delete_item">
                    <button type="submit">Remove</button>
                </form>
            </div>
			<?php // Add up the prices
			$total_price += $cart_item['price'];
			?>
        <?php endforeach; ?>
        <div class="total-price">
            <h4>Total Price: &pound;<?php echo $total_price; ?></h4>
        </div>
    <?php else: ?>
        <h3>Your cart is empty</h3>
    <?php endif; ?>
</div>
	</main>
	<footer>
		<section class="polaroid">
			<h2>© 2024, USN - Ultimate Sports Nutrition</h2>
			<img src="img/perserving.jpg" alt="per serving">
			<img src="img/strength.jpg" alt="strength">
			<img src="img/takeanytime.jpg" alt="take any time">
			<img src="img/buildmuscle.jpg" alt="build muscle">
	</section>
		<address>
			Written by Ali Alzabidi.<br>
			Visit us at Bury.Manchester.UK <br>
			Tel: 07736243497<br>
		</address>
	</footer>
	<script src="script.js"></script>
</body>
</html>