<?php 

require __DIR__.'/../autoload.php';

if (isset($_GET['current-profile'])) {
	$loadUser = $pdo -> prepare('SELECT * FROM users_view WHERE user_id = :user_id');
	$loadUser -> bindParam(':user_id', $_GET['current-profile'], PDO::PARAM_STR);
	$loadUser -> execute();
	$user = $loadUser -> FETCH(PDO::FETCH_ASSOC);
	$user['profile_pic_url'] = $user['profile_pic_url'] ?? 'avatar.jpg';
	$user['bio'] = $user['bio'] ?? '';

	if (isset($_SESSION['current-profile'])) { unset($_SESSION['current-profile']); }
	
	$_SESSION['current-profile'] = 
	[
		'user_id' => $user['user_id'],
		'username' => $user['username'], 
		'firstname' => $user['firstname'],
		'lastname' => $user['lastname'],
		'profile_pic' => $user['profile_pic_url'],
		'caption' => $user['caption'],
		'bio' => $user['bio'],
	];

	redirect('../posts/loadProfile.php');
}






?>
