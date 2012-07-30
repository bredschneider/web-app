<?php 
/**
* Registers the user to the Sweaty Betty Database.
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
session_start();
/**
*Hashes a new users password
*
*@param string $password The new user's original password
*@return string The new user's encrypted password
*/
function get_hashed_password ($password) {
	$rand = substr(strtr(base64_encode(openssl_random_pseudo_bytes(16)),'+','.'),0,22);
	$salt = '$2a$12$' . $rand;

	return crypt($password, $salt);
}

/**
*Checks to see if the user is already signed in
*
*@return boolean Whether or not the user is already signed in
*/
function user_is_signed_in () {
	if (
	!isset($_SESSION['user-id']) 
	||empty($_SESSION['user_id']) 
	|| !isset($_SESSION['fingerprint']) 
	|| $_SESSION['fingerprint'] != get_fingerprint($_SESSION['user_id']) 
	){
		return false;
	}
	
	return true;
}
/**
*Gets the new users username and password
*
*@param PDOConnection $db The opening connection to the database
*@param string $username The new user's username
*@param string $password The new user's password
*@return int Returns the user's id
*/
function user_get ($db, $username, $password) {
	$sql = $db->prepare('
	SELECT id, username, password
	FROM login
	WHERE username = :username
	LIMIT 1
	');
	$sql->bindValue(':username', $username, PDO::PARAM_STR);
	$sql->execute();
	$user =$sql->fetch();
	var_dump($user);
	if (empty($user) || !passwords_match($password, $user['password'])) {
		return false;
	}
	
	return $user['id'];
}
/**
*Checks to see if the user's password in the database matches the one entered
*
*@param string $pass_clear_text The user's original password
*@param string $pass_hashed The user's hashed password
*@return string Returns the user's hashed password
*/
function passwords_match ($pass_clear_text, $pass_hashed) {
	return crypt ($pass_clear_text, $pass_hashed) == $pass_hashed;
}
/**
*User signs into the application and commences the session
*
*@param int $user_id The user's corresponding ID
*/
function user_sign_in ($user_id) {
	session_regenerate_id();
	$_SESSION['user-id'] = $user_id;
	$_SESSION['fingerprint'] = get_fingerprint($user_id);
}
/**
*Gets the users fingerprint
*
*@param int $user_id The user's corresponding ID
*@return sha1 Information about the user's session
*/

function get_fingerprint ($user_id) {
	//IP address, session id and browser
	return sha1($user_id .  $_SERVER['REMOTE_ADDR'] . session_id() . $_SERVER['HTTP_USER_AGENT']);

}
/**
*User signs out of the application
*/
function user_sign_out () {
	$_SESSION = array();
	session_destroy();
	//create a page that would be used as the sign out page	
}