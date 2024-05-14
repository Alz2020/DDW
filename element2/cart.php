<?php
require_once "pdo.php";
$password = 'my secret password';
/* Secure password hash. */
$hash = password_hash($password, PASSWORD_DEFAULT);

if ( isset($_POST['name']) && isset($_POST['email']) 
    && isset($_POST['password'])) {
        $sql = "INSERT INTO users (name, email, password) 
              VALUES (:name, :email, :password)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
// Hashing the password before storing in the database

        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)));
	 }
$password = "abracadabra";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//echo $my_hash;

echo "<br><br>";

if (password_verify($password, $hashed_password)) {
    //echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
	<meta charset="UTF-8">
	<title>
            Cart
	</title>
	<link rel="stylesheet" type="text/css" href="memberArea.css">
	
	
</head>
<body>
<header>
		<img class="logo" src="img/logo.png" alt="logo">
		<h1>USN Dietary Supplement</h1>

		<nav>
			<ul class="pages">
				<li><span class='material-icons'></span><a href="Index.php">Home</a></li>
			</ul>
		</nav>	
	</header>



  <div class="shopping-cart">
    <h2>Shopping Cart</h2>
    <?php 
	$total_price = 0; // Initialize total price

	if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <?php foreach($_SESSION['cart'] as $index => $cart_item): ?>
            <div class="cart-item">
                <div class="item-details">
                    <h3><?php echo $cart_item['name']; ?></h3>
                    <h4>Price: &pound;<?php echo $cart_item['price']; ?></h4>
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

        <?php
// define variables and set to empty values



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
// define variables and set to empty and required values
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
	 if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["password"])) {
    $password = "";
  } else {
    $password = test_input($_POST["password"]);
  }

  
}

?>

        <form method="post" action="<?php 
		echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1>Sign Up</h1>
            <div>
                <label for="name">Your name:</label>
                <input type="text" name="name" id="name" required>
				<!-- Error message for name -->
                <span><?php echo $nameErr;?></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email"required>
				<!-- Error message for email -->
                <span><?php echo $emailErr;?></span>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"required>
				<!-- Error message for password -->
                <span><?php echo $passwordErr;?></span>
            </div>
            <button type="submit">Register</button>
            <h4>Already a member? <a href="login.php">Login here</a>
            Or click <a href="logout.php">Logout</a> to exit from this page.</h4>
        </form>

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