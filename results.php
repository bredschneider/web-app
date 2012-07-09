<?php
	require_once 'includes/db.php';
	
	$results = array();
	$errors = array();
	$workout = filter_input(INPUT_POST, 'workout', FILTER_SANITIZE_STRING);
	$muscle = filter_input(INPUT_POST, 'muscle', FILTER_SANITIZE_STRING);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if (!in_array($workout, array(3,6,9,12))) {
		$errors['workout'] = true;
	}
	
	if (!in_array($muscle, array(1,2,3,4,5))) {
		$errors['muscle'] = true;
	}

	if (empty($errors)) {
		$sql = $db->prepare('
		SELECT id, exercise, category
		FROM workout
		WHERE category = :category
		LIMIT :amount
		');
		$sql->bindValue(':category', $muscle, PDO::PARAM_INT);
		$sql->bindValue(':amount', (int) $workout, PDO::PARAM_INT);
		$sql->execute();

		$results= $sql->fetch();

	}
	
}


	
?>

<!DOCTYPE HTML>
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
		
		<div id="results">

        	<table>
            	<tr>
                	<td>Exercise</td>
                    <td>15 reps</td>
                    <td>15 reps</td>
                    <td>15 reps</td>
                </tr>
            	<?php foreach ($results as $workout):?>
                <tr>
                	<td><?php echo $results['exercise']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
    
        </div>
		
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
