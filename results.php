<?php 

require_once 'includes/db.php';

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
                	<td></td>
                </tr>
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
