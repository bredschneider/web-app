<?php 
require_once "includes/db.php";
require_once "includes/users.php";

//$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
//var_dump($_SESSION);

$sql=$db->prepare('
SELECT username
FROM login
WHERE id = :id
');

$sql->bindValue(':id', $_SESSION['user-id'], PDO::PARAM_INT);
$sql ->execute();
$user = $sql->fetch();

?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sweaty Betty - Homepage</title>
		<link href="css/general.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
	<header>
     	<nav id="welcome">
        	<ul>	
                <li>Welcome <?php echo $user['username'];?> | </li>
                <li><a href="sign-out.php">Logout</a></li>
            </ul>
        </nav>
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
		<nav id="primary-nav">
			<ul>
				<li class="current"><a href="homepage.html">My Workouts</a></li>
				<li><a href="/">Glossary</a></li>
			</ul>
		</nav>
	</header>
	<div class="content">	
		<form method="post" action="results.php" id="home">
			<fieldset id="time">
				<legend>How long do you have to workout?</legend>
				<input type="radio" id="15" name="workout" value="3">
				<label for="15">15 minutes</label>
				<input type="radio" id="30" name="workout" value="6">
				<label for="30">30 minutes</label>
				<input type="radio" id="45" name="workout" value="9">
				<label for="45">45 minutes</label>
				<input type="radio" id="60" name="workout" value="12">
				<label for="60">60 minutes</label>
			</fieldset>
			
			<fieldset id="muscle-group">
				<legend>What muscle group would you like to workout?</legend>
				<input type="radio" id="arms" name="muscle" value="1">
				<label for="arms">Arms</label>
				<input type="radio" id="back" name="muscle" value="2">
				<label for="back">Back</label>
				<input type="radio" id="chest" name="muscle" value="3">
				<label for="chest">Chest</label>
				<input type="radio" id="core" name="muscle" value="4">
				<label for="core">Core</label>
				<input type="radio" id="legs" name="muscle" value="5">
				<label for="legs">Legs</label>
			</fieldset>
			
			<button type="submit">Submit</button>
		</form>
	</div>	
		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
		</footer>
	</body>
</html>
