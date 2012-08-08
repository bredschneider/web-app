<?php 
/**
* Opens a conncection to the MYSQL Database.
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
/*
$user = trim(stripslashes(getenv('DB_USER')));
$pass = trim(stripslashes(getenv('DB_PASS')));
$data_source = trim(stripslashes(getenv('DATA_SOURCE')));
*/
$user = trim(stripslashes(getenv('MYSQL_USERNAME')));
$pass = trim(stripslashes(getenv('MYSQL_PASSWORD')));
$host = trim(stripslashes(getenv('MYSQL_DB_HOST')));
$dbname = trim(stripslashes(getenv('MYSQL_DB_NAME')));
$data_source = 'mysql:host=' . $host . ';dbname=' . $dbname;

var_dump($user, $pass, $data_source);

$db = new PDO($data_source, $user, $pass);

var_dump($db);
exit;
// UTF8 to communicate in all  human languages
$db->exec('SET NAMES utf8');