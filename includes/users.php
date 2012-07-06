<?php 

session_start();

function get_hashed_password ($password) {
	$rand = substr(strtr(base64_encode(openssl_random_pseudo_bytes(16)),'+','.'),0,22);
	$salt = '$2a$12$' . $rand;

	return crypt($password, $salt);
}

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

function passwords_match ($pass_clear_text, $pass_hashed) {
	return crypt ($pass_clear_text, $pass_hashed) == $pass_hashed;
}

function user_sign_in ($user_id) {
	session_regenerate_id();
	$_SESSION['user-id'] = $user_id;
	$_SESSION['fingerprint'] = get_fingerprint($user_id);
}


function get_fingerprint ($user_id) {
	//IP address, session id and browser
	return sha1($user_id .  $_SERVER['REMOTE_ADDR'] . session_id() . $_SERVER['HTTP_USER_AGENT']);

}

function user_sign_out () {
	$_SESSION = array();
	session_destroy();
	//create a page that would be used as the sign out page	
}