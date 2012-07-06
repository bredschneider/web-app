<?php 

//Opena s conntection the MySQL database
//Shared between all the PHP files in our application

//PDO : PHP Database Object
//Allows us to connect to many different kinds of databases

$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$data_source = getenv('DATA_SOURCE');
$db = new PDO($data_source, $user, $pass);
// UTF8 to communicate in all  human languages
$db->exec('SET NAMES utf8');