<?php
require_once 'includes/db.php';
	
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	
$sql=$db->prepare('
SELECT id, exercise, caetgory, description
FROM workout
WHERE id = :id;
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql ->execute();
$results = $sql->fetch();
	
?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Glossary</title>
		<link href="css/general.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
	<header>
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
		<nav id="primary-nav">
			<ul>
				<li><a href="homepage.php">My Workouts</a></li>
				<li class="current"><a href="/">Glossary</a></li>
			</ul>
		</nav>
	</header>
	<div class="glossary">
		<h2><?php echo $results['exercise']; ?></h2>
		<h3>Muscle Group:<?php echo $results['category']; ?></h3>
		<div class="images">
		</div>
		<h4>Description</h4>
		<ol>
			<li><?php echo $results['description']; ?></li>
		</ol>
        <a href="">Return to Workout</a>
	</div> 
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
	</body>
</html>
