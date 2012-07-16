<?php
	require_once 'includes/db.php';
	require_once 'includes/users.php';
	
$sql=$db->prepare('
SELECT username
FROM login
WHERE id = :id
');

$sql->bindValue(':id', $_SESSION['user-id'], PDO::PARAM_INT);
$sql ->execute();
$user = $sql->fetch();

	
	
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

		$results= $sql->fetchAll();

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
        <nav id="welcome">	
            <li>Welcome <?php echo $user['username']; ?> |</li>
            <li><a href="sign-out.php">Logout</a></li>
    	</nav>
	<header>
		<a href="index.php"><h1>Sweaty Betty</h1><img src="images/logo.png" alt="Sweaty Betty Logo"></a>
		<h2>Because Strong is the New Skinny.</h2>
		<nav id="primary-nav">
			<ul>
				<li class="current"><a href="homepage.php">My Workouts</a></li>
				<li><a href="/">Glossary</a></li>
			</ul>
		</nav>
	</header>
	
    <div class="content">
		<div id="results">
			<h3>Your Results</h3>
        	<table>
            	<thead>
                	<th>Exercise</th>
                    <th>15 reps</th>
                    <th>15 reps</th>
                    <th>15 reps</th>
                </thead>
                <tbody>
            	<?php foreach ($results as $exercise):?>
                <tr>
                	<td><a href="glossary.php?id=<?php echo $exercise['id'] ?>"><?php echo $exercise['exercise']; ?></a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
    
        </div>
     </div>
		
		<footer>
			<p>Before undertaking any exercise program, be sure to consult your physician.</p>
		</footer>
	</body>
</html>
