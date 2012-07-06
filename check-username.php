<?php 

require_once 'includes/db.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING) ;
$sql = $db ->prepare('
	SELECT id
	FROM login
	WHERE username = :username
');

$sql->bindValue(':username', $username, PDO::PARAM_STR);
$sql->execute();
$results = $sql->fetch();

if (empty($results)) {
	echo 'available';	
}else {
	echo 'unavailable';	
}