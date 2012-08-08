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

$user = trim(stripslashes(getenv('MYSQL_USERNAME')));
$pass = trim(stripslashes(getenv('MYSQL_PASSWORD')));
$host = trim(stripslashes(getenv('MYSQL_DB_HOST')));
$dbname = trim(stripslashes(getenv('MYSQL_DB_NAME')));
$data_source = 'mysql:host=' . $host . ';dbname=' . $dbname;

$db = new PDO($data_source, $user, $pass);
// UTF8 to communicate in all  human languages
$db->exec('SET NAMES utf8');