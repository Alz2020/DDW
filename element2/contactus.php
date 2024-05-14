<?php
require_once "pdo.php";
$message = "";
if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    // Sanitize input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    // Insert data into the database
    $sql = "INSERT INTO contacts (name, email, message) 
            VALUES (:name, :email, :message)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':message' => $_POST['message'],
        ));
        echo ("Your message has been submitted successfully!<br />\n");
} else {
    echo "Please fill in all of the fields.";
} 
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<title>
		Contact Us
	</title>
	<link rel="stylesheet" type="text/css" href="contact.css">	
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>
	<header>
		<img class="logo" src="img/logo.png" alt="logo">
		<h1>USN Dietary Supplement</h1>
		<nav>
			<ul class="pages">
				<li><span class='material-icons'></span><a href="Index.php">Home</a></li>
			</ul>
		</nav>	
	</header>
	<main>
		<h2>Contact Us</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required><br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required><br><br>
			<label for="message">Message:</label><br>
			<textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
			<input type="submit" value="Submit">
		</form>	
		<?php echo $message;?> 		
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


