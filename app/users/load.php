<?php 

require __DIR__.'/../autoload.php';

if (isset($_GET['current-profile'])) {
	$loadUser = $pdo -> prepare('SELECT user_id, firstname, lastname, username, profile_image, bio FROM users WHERE user_id = :user_id');
	$loadUser -> bindParam(':user_id', $_GET['current-profile'], PDO::PARAM_INT);
	$loadUser -> execute();
	$user = $loadUser -> FETCH(PDO::FETCH_ASSOC);

	if (isset($_SESSION['current-profile'])) { unset($_SESSION['current-profile']); }
	
	$_SESSION['current-profile'] = 
	[
		'user_id' => $user['user_id'],
		'firstname' => $user['firstname'],
		'lastname' => $user['lastname'],
		'username' => $user['username'], 
		'profile_image' => $user['profile_image'],
		'bio' => $user['bio'],
	];

	redirect('../posts/loadProfile.php');
}






?>
