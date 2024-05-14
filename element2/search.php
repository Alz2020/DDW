<?php
require_once "pdo.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the search query from the form
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

    // Check if the search query is empty
    if (!empty($search_query)) {
    // SQL query to search for items matching the search query
        $sql = "SELECT * FROM cart_items WHERE item_name LIKE :search_query";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':search_query' => "%$search_query%"));
        $results = $stmt->fetchAll();
    }
}    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<link rel="stylesheet" type="text/css" href="text.css">
<body>
	<header>
		<img class="logo" src="img/logo.png" alt="logo">
		<h1>USN Dietary Supplement</h1>

		<nav>
			<ul class="pages">
				<li><span class='material-icons'></span><a href="home.php">Home</a></li>				
			</ul>
		</nav>	
	</header>
	
<?php
    // Display search results
    if (!empty($results)) {
        foreach ($results as $row) {
            // Display the search results as product boxes
            echo "<section class='product-box'>";
            echo "<h2>" . htmlspecialchars($row['item_name']) . "</h2>";
            echo "<a class='product-img'><img src='" . htmlspecialchars($row['item_image']) . "' alt='" . htmlspecialchars($row['item_name']) . "'></a>";
            echo "<div class='product-text'>";
            echo "<h4 class='product-name'>" . htmlspecialchars($row['item_name']) . "</h4>";
            echo "<span class='price'>&pound;" . htmlspecialchars($row['item_price']) . "</span>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='add_to_cart'>";
            echo "<input type='hidden' name='item_name' value='" . htmlspecialchars($row['item_name']) . "'>";
            echo "<input type='hidden' name='item_price' value='" . htmlspecialchars($row['item_price']) . "'>";
            echo "<input type='hidden' name='item_image' value='" . htmlspecialchars($row['item_image']) . "'>";
            echo "<button type='submit'>Add to Cart</button>";
            echo "</form>";
            echo "</div>";
            echo "</section>";
        }
    } else {
        echo "No results found.";
    }

?>

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