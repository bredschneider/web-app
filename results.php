<?php
	require_once 'includes/db.php';
	require_once 'includes/users.php';

if (!isset($_SESSION['workout']) || !isset($_SESSION['muscle'])) {
	header('Location: homepage.php');
	exit;
}

$sql=$db->prepare('
SELECT username
FROM login
WHERE id = :id
');

$sql->bindValue(':id', $_SESSION['user-id'], PDO::PARAM_INT);
$sql ->execute();
$user = $sql->fetch();
	
$sql = $db->prepare('
SELECT id, exercise, category
FROM workout
WHERE category = :category
LIMIT :amount
');
$sql->bindValue(':category', $_SESSION['muscle'], PDO::PARAM_INT);
$sql->bindValue(':amount', (int) $_SESSION['workout'], PDO::PARAM_INT);
$sql->execute();

$results= $sql->fetchAll();

	
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
				<li><a href="results.php">Glossary</a></li>
			</ul>
		</nav>
	</header>
	
    <div class="content">
		<div id="results">
			<h3>Your Results</h3>
            <h4>*All workouts operate on the principle that each set of 15 reps should take one minute to complete. When a set of 15 is completed you can take a one minute rest. Happy Workout!</h4>
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
