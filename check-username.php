<?php 
/**
* Checks to see if the username can be found within the database
*
*@author Jessica Bredschneider <jessica.bredschneider@gmail.com>
*@copyright 2012 Jessica Bredschneider
*@license BSD-3-Clause <http://github.com/jbred034/web-app/NEW-BSD-LICENSE.txt>
*@version 1.0.0
*@package Sweaty Betty
*
*
*
*/
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