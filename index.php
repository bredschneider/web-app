<?php 

require_once 'includes/db.php';
require_once 'includes/users.php';

$errors = array();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($username)) {
		$errors['username'] = true;
	}
	if (empty($password)) {
		$errrors ['password'] = true;
	}
	if (empty($errors)) {
		$user_id = user_get($db, $username, $password);
		
		if ($user_id) {
			
			user_sign_in($user_id);
			header('Location: homepage.php');
		

		}else {
			$errors['no-user'] = true;
		}
	}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sweaty Betty - Login</title>
		<link href="css/general.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
	<header>
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo-2.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
	</header>
    
    <div class="content">
		<form id="login" method="post" action="index.php">
			<div>
				<label for="username">Username</label>
				<input id="username" name="username" required>
			</div>
			<div>
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
			</div>
			<button type="submit">Login</button>
			<p>New to the site? Register <a href="register.php">here</a>.</p>
			</div>
		</form>
     </div>
     
		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
			<nav id="secondary-nav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about-us.html">About Us</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
		</footer>
	</body>
</html>
