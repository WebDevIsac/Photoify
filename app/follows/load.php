<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['user'])) {

	$userID = $_SESSION['user']['user_id'];


	$stmtFollowing = $pdo -> prepare('SELECT * FROM following WHERE user_id = :user_id');
	$stmtFollowing -> bindParam(':user_id', $userID, PDO::PARAM_INT);
	$stmtFollowing -> execute();
	$stmtFollowing = $stmtFollowing -> fetchAll(PDO::FETCH_ASSOC);

	unset($_SESSION['following']);
	if (count($stmtFollowing) > 0) {
		foreach ($stmtFollowing as $follow) {
			$loadFollowing = $pdo -> prepare('SELECT user_id, username FROM users WHERE user_id = :user_id');
			$loadFollowing -> bindParam(':user_id', $follow['follow_id'], PDO::PARAM_INT);
			$loadFollowing -> execute();
			
			$loadFollowing = $loadFollowing -> fetchAll(PDO::FETCH_ASSOC);
			foreach ($loadFollowing as $loadFollow) {
				$_SESSION['following'][] = [
					'user_id' => $loadFollow['user_id'],
					'username' => $loadFollow['username']
				];
			}
		}
	}
	
	$stmtFollowers = $pdo -> prepare('SELECT * FROM followers WHERE user_id = :user_id');
	$stmtFollowers -> bindParam(':user_id', $userID, PDO::PARAM_INT);
	$stmtFollowers -> execute();
	$stmtFollowers = $stmtFollowers -> fetchAll(PDO::FETCH_ASSOC);
	
	if (count($stmtFollowers) > 0) {
		unset($_SESSION['followers']);
		foreach ($stmtFollowers as $follower) {
			$loadFollowers = $pdo -> prepare('SELECT user_id, username FROM users WHERE user_id = :user_id');
			$loadFollowers -> bindParam(':user_id', $follower['follower_id'], PDO::PARAM_INT);
			$loadFollowers -> execute();
			$loadFollowers = $loadFollowers -> fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($loadFollowers as $loadFollower) {
				
				$_SESSION['followers'][] = [
					'user_id' => $loadFollower['user_id'],
					'username' => $loadFollower['username']
				];
			}
		}
	}
		redirect('../posts/load.php');
}

?>
