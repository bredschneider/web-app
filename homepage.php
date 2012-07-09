<?php
	require_once 'includes/db.php';
	
	$errors = array();
	
	$_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
	
	$workout = filter_input(INPUT_POST, 'workout', FILTER_SANITIZE_STR);
	$muscle = filter_input(INPUT_POST, 'muslce', FILTER_SANITIZE_STR);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if ($workout !='15' || $workout !='30' || $workout !='45' || $workout != '60') {
			$errors['workout'] = true;
		}
		
		if ($msucle !='arms' || $muscle !='back' || $muscle !='chest' || $muscle != 'core' || $muscle != 'legs') {
			$errors['workout'] = true;
		}
		
	}

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
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
		<nav id="primary-nav">
			<ul>
				<li class="current"><a href="homepage.html">My Workouts</a></li>
				<li><a href="/">Glossary</a></li>
			</ul>
		</nav>
	</header>
		
		<form method="psot" action="homepage.php" id="home">
			<fieldset id="time">
				<legend>How long do you have to workout?</legend>
				<input type="radio" id="15" name="workout" value="0">
				<label for="15">15 minutes</label>
				<input type="radio" id="30" name="workout" value="1">
				<label for="30">30 minutes</label>
				<input type="radio" id="45" name="workout" value="2">
				<label for="45">45 minutes</label>
				<input type="radio" id="60" name="workout" value="3">
				<label for="60">60 minutes</label>
			</fieldset>
			
			<fieldset id="muscle-group">
				<legend>What muscle group would you like to workout?</legend>
				<input type="radio" id="arms" name="muscle" value="0">
				<label for="arms">Arms</label>
				<input type="radio" id="back" name="muscle" value="1">
				<label for="back">Back</label>
				<input type="radio" id="chest" name="muscle" value="2">
				<label for="chest">Chest</label>
				<input type="radio" id="core" name="muscle" value="3">
				<label for="core">Core</label>
				<input type="radio" id="legs" name="muscle" value="4">
				<label for="legs">Legs</label>
			</fieldset>
			
			<button type="submit">Submit</button>
		</form>
		
		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
			<nav id="secondary-nav">
				<ul>
					<li><a href="homepage.php">Home</a></li>
					<li><a href="about-us.html">About Us</a></li>
					<li><a href="contact-us.html">Contact</a></li>
				</ul>
			</nav>
		</footer>
	</body>
</html>
