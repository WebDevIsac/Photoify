<?php 

require __DIR__.'/../autoload.php';

if (isset($_GET['current-profile'])) {
	$loadUser = $pdo -> prepare('SELECT * FROM users_view WHERE user_id = :user_id');
	$loadUser -> bindParam(':user_id', $_GET['current-profile'], PDO::PARAM_INT);
	$loadUser -> execute();
	$user = $loadUser -> FETCH(PDO::FETCH_ASSOC);
	$user['profile_pic_url'] = $user['profile_pic_url'] ?? 'default.jpg';
	$user['bio'] = $user['bio'] ?? '';
	if (!isset($user['profile_pic_url'])) {

	}

	if (!isset($user['profile_pic_url'])) {

	}
	$_SESSION['current-profile'] = 
	[
		'user_id' => $user['user_id'],
		'username' => $user['username'], 
		'firstname' => $user['firstname'],
		'lastname' => $user['lastname'],
		'profile_pic_url' => $user['profile_pic_url'],
		'bio' => $user['bio']
	];

	redirect('../../profile.php');
}






?>
