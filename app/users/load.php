<?php 

require __DIR__.'/../autoload.php';

if (isset($_GET['current-profile'])) {
	$loadUser = $pdo -> prepare('SELECT * FROM users_view WHERE username = :username');
	$loadUser -> bindParam(':username', $_GET['current-profile'], PDO::PARAM_STR);
	$loadUser -> execute();
	$user = $loadUser -> FETCH(PDO::FETCH_ASSOC);
	$user['profile_pic_url'] = $user['profile_pic_url'] ?? 'avatar.jpg';
	$user['bio'] = $user['bio'] ?? '';

	$_SESSION['current-profile'] = 
	[
		'user_id' => $user['user_id'],
		'username' => $user['username'], 
		'firstname' => $user['firstname'],
		'lastname' => $user['lastname'],
		'profile_pic' => $user['profile_pic_url'],
		'bio' => $user['bio']
	];

	redirect('../../profile.php');
}






?>
