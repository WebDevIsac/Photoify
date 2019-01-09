<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['user'])) {

	$userId = $_SESSION['user']['id'];

	$loadFollowing = $pdo -> prepare('SELECT * FROM following WHERE user_id = :user_id');
	$loadFollowing -> bindParam(':user_id', $userId, PDO::PARAM_INT);
	
	$loadFollowing -> execute();
	
	$following = $loadFollowing -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($following as $follow) {
		$followingArray[] = $follow['follow_id'];
	}

	$_SESSION['following'] = $followingArray;

	$loadFollowers = $pdo -> prepare('SELECT * FROM followers WHERE user_id = :user_id');
	$loadFollowers -> bindParam(':user_id', $userId, PDO::PARAM_INT);

	$loadFollowers -> execute();

	$followers = $loadFollowers -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($followers as $follower) {
		$followersArray[] = $follower['user_id'];
	}

	$_SESSION['followers'] = $followersArray;

	redirect('../posts/load.php');

}

?>
