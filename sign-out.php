<?php 
/**
* Signs the user out of the Sweaty Betty application.
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

require_once 'includes/users.php';
user_sign_out();
header('Location: index.php');