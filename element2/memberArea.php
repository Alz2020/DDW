<?php
require_once "pdo.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Hashing the password before storing it in the database
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $name,
        ':email' => $email,
        ':password' => $password
    ));
}
// Verifying password
$passwordToVerify = "abracadabra";
$hashed_password = password_hash($passwordToVerify, PASSWORD_DEFAULT);
echo "<br><br>";
if (password_verify($passwordToVerify, $hashed_password)) {
    //echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Member Area</title>
	<link rel="stylesheet" type="text/css" href="memberArea.css">
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>
	<header>
		<img class="logo" src="img/logo.png" alt="logo">
		<h1>USN Dietary Supplement</h1>
		<nav>
			<ul class="pages">
				<li><span class='material-icons'></span><a href="Index.php">Home</a></li> 
        <li><a href="cart.php">Cart</a></li>              
			</ul>
		</nav>
	</header>
  <main>
<?php
// define variables and set to empty values
$name = $email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
}
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
        </main>
<script src="script.js"></script>  
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
</body>
</html>