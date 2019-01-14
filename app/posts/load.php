<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['following'])) {

	$loadAllUsers = $pdo -> query('SELECT * FROM users');
	$loadAllUsers = $loadAllUsers -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($_SESSION['following'] as $follow) {

		$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
		$loadPosts -> bindParam(':user_id', $follow['follow_id'], PDO::PARAM_INT);
		$loadPosts -> execute();
		$loadPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);

		foreach ($loadPosts as $userPost) {
			$posts[] = $userPost;
			$dates[] = $userPost['timestamp'];
			
			$loadLikes = $pdo -> prepare('SELECT * FROM likes WHERE post_id = :post_id');
			$loadLikes -> bindParam(':post_id', $userPost['post_id'], PDO::PARAM_INT);
			$loadLikes -> execute();
			$loadLikes = $loadLikes -> fetchAll(PDO::FETCH_ASSOC);
			if (!$loadLikes) {
				$count = 0;
			} else {
				$likes[] = $loadLikes;
			}
		}
	}

	rsort($dates);
	unset($_SESSION['posts']);

	foreach ($dates as $date) {
		foreach ($loadAllUsers as $user) {
			foreach ($posts as $post) {
				foreach ($likes as $like) {
					if ($like['post_id'] === $post['post_id']) {
						echo $like['post_id'];
						if ($like['post_id'] === $post['post_id']) {
							if ($user['user_id'] === $post['user_id']) {
								if ($post['timestamp'] === $date) {		
									$_SESSION['posts'][] = 
									[
										'post_id' => $post['post_id'],
										'photo_url' => $post['photo_url'],
										'username' => $post['username'],
										'user_id' => $post['user_id'],
										'profile_pic' => $user['profile_pic_url'],
										'timestamp' => $date,
										'caption' => $post['caption'],
										'likes' => $post['likes']
									];
								}
							}
						}
					}
				}
			}
		}
	}

	die;
	
	redirect('../../index.php');
}

?>
