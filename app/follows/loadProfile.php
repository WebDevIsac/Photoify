<?php 

require __DIR__.'/../autoload.php';


if (isset($_SESSION['current-profile'])) {
	$loadFollowing = $pdo -> prepare('SELECT * FROM following WHERE user_id = :user_id');
	$loadFollowing -> bindParam(':user_id', $_SESSION['current-profile']['user_id'], PDO::PARAM_INT);
	$loadFollowing -> execute();
	$following = $loadFollowing -> fetchAll(PDO::FETCH_ASSOC);
	unset($_SESSION['current-profile']['following']);
	if (count($following) > 0) {
		foreach ($following as $follow) {	
			$_SESSION['current-profile']['following'][] = 
			[
				'following' => $follow['follow_id']
			];
		}
	} 

	$loadFollowers = $pdo -> prepare('SELECT * FROM followers WHERE user_id = :user_id');
	$loadFollowers -> bindParam(':user_id', $_SESSION['current-profile']['user_id'], PDO::PARAM_INT);
	$loadFollowers -> execute();
	$followers = $loadFollowers -> fetchAll(PDO::FETCH_ASSOC);
	unset($_SESSION['current-profile']['followers']);
	if (count($followers) > 0) {
		foreach ($followers as $follower) {	
			$_SESSION['current-profile']['followers'][] = 
			[
				'follower' => $follower['follower_id']
			];
		}
	} 
	if (isset($_SESSION['like_post_id'])) {
		redirect('../../profile.php#' . $_SESSION['like_post_id']);
	}

	redirect('../../profile.php');

}
