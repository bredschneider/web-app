<?php
	require_once 'includes/db.php';
	require_once 'includes/users.php';
	
	$errors = array();
	
	$first_name = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
	$last_name = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
	
	if ($_SERVER['REQUEST_METHOD'] =='POST') {
	if (strlen($first_name) < 1 || strlen($first_name) > 256) {
		$errors['first-name'] = true;
	}
	if (strlen($last_name) < 1 || strlen($last_name) > 256) {
		$errors['last-name'] = true;
	}
	if (strlen($email) < 1 || strlen($email) > 256) {
		$errors['email'] = true;
	}
	if (strlen($username) < 1 || strlen($username) > 256) {
		$errors['username'] = true;
	}
	if (strlen($password) < 1 || strlen($password) > 256) {
		$errors['password'] = true;
	}
if (empty($errors)) {
		$sql = $db->prepare('
		INSERT INTO login (first_name, last_name, email, username, password)
		VALUES (:first_name, :last_name, :email, :username, :password)
		');
		$sql->bindValue(':first_name', $first_name, PDO::PARAM_STR);
		$sql->bindValue(':last_name', $last_name, PDO::PARAM_STR);
		$sql->bindValue(':email', $email, PDO::PARAM_STR);
		$sql->bindValue(':username', $username, PDO::PARAM_STR);
		$sql->bindValue(':password', get_hashed_password($password), PDO::PARAM_STR);
		$sql->execute();
		//var_dump($sql->errorInfo());
		header('location:index.php');
		exit;
	}
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sweaty Betty - Register</title>
		<link href="css/general.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
	</head>

	<body>
	<header>
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
	</header>
		<form id="register" method="post" action="register.php">
			<div>
				<label for="first-name">First Name</label>
				<input id="first-name" name="first-name" required>
			</div>
			<div>
				<label for="last-name">Last Name</label>
				<input id="last-name" name="last-name" required>
			</div>
			<div>
				<label for="email">Email</label>
				<input type="email" id="email" name="email">
			</div>
			<div>
				<label for="username">Username</label>
				<input id="username" name="username" required>
				<strong class="user-available" data-status="unchecked">Available</strong>
			</div>
			<div>
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
			</div>
			<button type="submit">Submit</button>
		</form>
		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
			<nav id="secondary-nav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="">About Us</a></li>
					<li><a href="">Contact</a></li>
				</ul>
			</nav>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="js/general.js"></script>
	</body>
</html>
