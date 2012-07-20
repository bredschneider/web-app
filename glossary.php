<?php
require_once 'includes/db.php';
require_once 'includes/users.php';

$categories = array(
	''
	, 'Arms'
	, 'Back'
	, 'Chest'
	, 'Core'
	, 'Legs'
);

$sql=$db->prepare('
SELECT username
FROM login
WHERE id = :id
');

$sql->bindValue(':id', $_SESSION['user-id'], PDO::PARAM_INT);
$sql ->execute();
$user = $sql->fetch();
	
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	
$sql=$db->prepare('
SELECT id, exercise, category, definition
FROM workout
WHERE id = :id;
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql ->execute();
$results = $sql->fetch();


//var_dump($category);

?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Glossary</title>
		<link href="css/general.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
         <nav id="welcome">	
        	<li>Welcome <?php echo $user['username'];?> |</li>
            <li><a href="sign-out.php">Logout</a></li>
        </nav>
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
    
    <div class="content">
        <div id="glossary">
            <h2><?php echo $results['exercise']; ?></h2>
            <h3>Muscle Group: <?php echo $categories[$results['category']]; ?></h3>
            <h4>Description</h4>
            	<p><?php echo $results['definition']; ?></p>
            <a href="results.php">Return to Workout</a>
        </div> 
    </div>
    
 		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
		</footer>
	</body>
</html>
