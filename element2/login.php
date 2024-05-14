<?php
require_once "pdo.php";
    session_start();
	if ( isset($_POST['email']) && isset($_POST['password'])) {
	// Sanitize input
	   $typed_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	   $typed_password = $_POST['password']; 	
    // Prepare SQL statement to fetch user with email and hashed password
    $sql = "SELECT * FROM users WHERE email = :email";
	$stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $typed_email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
	// Verify hashed password against typed password
    if ($user && password_verify($typed_password, $user['password'])) {
        $_SESSION["user"] = $user["user_id"];
		$_SESSION["email"] = $user["email"];
	// Set a cookie for the user
	setcookie('user_email', $typed_email, time() + (86400 * 30), "/"); // Cookie expires in 30 days
	setcookie('user_id', $user["user_id"], time() + (86400 * 30), "/"); // Cookie expires in 30 days
        // Redirect to user.php on successful login
         header('Location: user.php');
        exit(); // Terminate script after redirection
    } else {
        echo "You must enter a correct email and password";
    }
}
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<title>
		USN dietary supplement
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
				<li><a href="MemberArea.php">Member Area</a></li>
			</ul>
		</nav>		
	</header>
	<main>
		<form action="" method="post">
			<h1>Login</h1>
			<div>
				<label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password"required>
				<a href="user.php"><input type="submit" value="Login"/></a>
			</div>
		</form>
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