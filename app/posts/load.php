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
			$loadLikes = $pdo -> prepare('SELECT * FROM likes WHERE post_id = :post_id');
			$loadLikes -> bindParam(':post_id', $userPost['post_id'], PDO::PARAM_INT);
			$loadLikes -> execute();
			$loadLikes = $loadLikes -> fetchAll(PDO::FETCH_ASSOC);
			if (!$loadLikes) {
				$count = 0;
				$isLiked = false;
			} else {
				$count = count($loadLikes);
				foreach ($loadLikes as $like) {
					if ($like['user_id'] == $_SESSION['user']['user_id']) {
						$isLiked = true;
					} else {
						$isLiked = false;
					}
				}
			}
			$userPost['is_liked'] = $isLiked;
			

			$userPost['likes'] = $count;

			$posts[] = $userPost;
			$dates[] = $userPost['timestamp'];
		}
	}
	
	rsort($dates);
	unset($_SESSION['posts']);

	foreach ($dates as $date) {
		foreach ($loadAllUsers as $user) {
			foreach ($posts as $post) {
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
							'likes' => $post['likes'],
							'is_liked' => $post['is_liked']
						];
					}
				}
			}
		}
	}

	if (isset($_SESSION['like_post_id'])) {
		redirect('../../index.php#' . $_SESSION['like_post_id']);
	}
	
	redirect('../../index.php');
}

?>
