<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['user'])) {

	$userId = $_SESSION['user']['id'];

	$loadFollowers = $pdo -> prepare('SELECT * FROM followers WHERE user_id = :user_id');
	$loadFollowers -> bindParam(':user_id', $userId, PDO::PARAM_STR);

	$loadFollowers -> execute();

	$followers = $loadFollowers -> fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($followers as $follower) {
		if (!in_array($follower['follow_id'], $_SESSION['followers'])) {
			$_SESSION['followers'][] = $follower['follow_id'];
		}
	}
	
	$loadFollowing = $pdo -> prepare('SELECT * FROM following WHERE follow_id = :follow_id');
	$loadFollowing -> bindParam(':follow_id', $userId, PDO::PARAM_STR);
	
	$loadFollowing -> execute();
	
	$following = $loadFollowing -> FETCH(PDO::FETCH_ASSOC);
	
	foreach ($following as $follow) {
		if (!in_array($follower['user_id'], $_SESSION['following'])) {
			$_SESSION['following'][] = $follow['user_id'];
		}
	}

	redirect('/../posts/load.php');

}

?>
