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


// DELETE user

if ( isset($_POST['delete']) && isset($_POST['user_id']) ) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    //echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
}

// Updating a user
if (isset($_POST['update']) && isset($_POST['user_id'])) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['new_name'],
        ':email' => $_POST['new_email'],
        ':user_id' => $_POST['user_id']
    ));
}

// Fetching all users

$stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>admin</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
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
    <table class="styled-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['password']); ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <input type="submit" value="Del" name="delete">
                        <input type="submit" value="Edit" name="edit">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="new-user-form">
    <h4>Add A New User</h4>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" size="40" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Add New">
        </div>
    </form>
</div>
<?php if (isset($_POST['edit']) && isset($_POST['user_id'])) : ?>
    <?php
    // Fetching user information based on user ID for editing
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $_POST['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <form method="post">
        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
        <p>New Name: <input type="text" name="new_name" value="<?= $user['name'] ?>" required></p>
        <p>New Email: <input type="text" name="new_email" value="<?= $user['email'] ?>" required></p>
        <p><input type="submit" value="Update"/></p>
    </form>
<?php endif; ?>
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
</body>
</html>
