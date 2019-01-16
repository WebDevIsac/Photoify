<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['current-profile'], $_SESSION['user'])) {

	$user = $_SESSION['user'];
	$profile = $_SESSION['current-profile'];
	if (isset($_SESSION['following'])) {
		foreach ($_SESSION['following'] as $follow) {
			if ($follow['user_id'] == $_SESSION['current-profile']['user_id']) {
				
				$removeFollowing = $pdo -> prepare('DELETE FROM following WHERE user_id = :user_id AND follow_id = :follow_id');
				$removeFollowing -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
				$removeFollowing -> bindParam(':follow_id', $profile['user_id'], PDO::PARAM_INT);
				$removeFollowing -> execute();
				
				$removeFollower = $pdo -> prepare('DELETE FROM followers WHERE user_id = :user_id AND follower_id = :follow_id');
				$removeFollower -> bindParam(':user_id', $profile['user_id'], PDO::PARAM_INT);
				$removeFollower -> bindParam(':follow_id', $user['user_id'], PDO::PARAM_INT);
				$removeFollower -> execute();
				
			} else {
				
				$addFollowing = $pdo -> prepare('INSERT INTO following(user_id, follow_id) VALUES(:user_id, :follow_id)');
				$addFollowing -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
				$addFollowing -> bindParam(':follow_id', $profile['user_id'], PDO::PARAM_INT);
				$addFollowing -> execute();
				
				$addFollower = $pdo -> prepare('INSERT INTO followers(user_id, follower_id) VALUES(:user_id, :follow_id)');
				$addFollower -> bindParam(':user_id', $profile['user_id'], PDO::PARAM_INT);
				$addFollower -> bindParam(':follow_id', $user['user_id'], PDO::PARAM_INT);
				$addFollower -> execute();
			}
		}
			
	} else {
		$addFollowing = $pdo -> prepare('INSERT INTO following(user_id, follow_id) VALUES(:user_id, :follow_id)');
		$addFollowing -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
		$addFollowing -> bindParam(':follow_id', $profile['user_id'], PDO::PARAM_INT);
		$addFollowing -> execute();
		
		$addFollower = $pdo -> prepare('INSERT INTO followers(user_id, follower_id) VALUES(:user_id, :follow_id)');
		$addFollower -> bindParam(':user_id', $profile['user_id'], PDO::PARAM_INT);
		$addFollower -> bindParam(':follow_id', $user['user_id'], PDO::PARAM_INT);
		$addFollower -> execute();
	}

	redirect('load.php');
}
