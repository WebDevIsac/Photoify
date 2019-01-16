<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Update like for current profile
if (isset($_GET['post'])) {
	$postId = filter_var($_GET['post'], FILTER_SANITIZE_NUMBER_INT);

	$loadLikes = $pdo -> prepare('SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id');
	$loadLikes -> bindParam(':post_id', $postId, PDO::PARAM_INT);
	$loadLikes -> bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
	$loadLikes -> execute();
	$loadLikes = $loadLikes -> FETCH(PDO::FETCH_ASSOC);

	if (!$loadLikes) {
		$storeLike = $pdo -> prepare('INSERT INTO likes(post_id, user_id) VALUES(:post_id, :user_id)');
		$storeLike -> bindParam(':post_id', $postId, PDO::PARAM_INT);
		$storeLike -> bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
		$storeLike -> execute();
	} else {
		$deleteLike = $pdo -> prepare('DELETE FROM likes WHERE post_id = :post_id and user_id = :user_id');
		$deleteLike -> bindParam(':post_id', $postId, PDO::PARAM_INT);
		$deleteLike -> bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
		$deleteLike -> execute();
	}

	$_SESSION['like_post_id'] = $postId;
}

if (isset($_SESSION['current-profile'])) {
	$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
	$loadPosts -> bindParam(':user_id', $_SESSION['current-profile']['user_id'], PDO::PARAM_INT);
	$loadPosts -> execute();
	$loadPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);
	if ($loadPosts[0]) {
		foreach ($loadPosts as $loadPost) {
			$loadLikes = $pdo -> prepare('SELECT * FROM likes WHERE post_id = :post_id');
			$loadLikes -> bindParam(':post_id', $loadPost['post_id'], PDO::PARAM_INT);
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
			$loadPost['is_liked'] = $isLiked;
			$loadPost['likes'] = $count;
			
			$posts[] = $loadPost;
			$dates[] = $loadPost['timestamp'];
		}
		
		rsort($dates);
		unset($_SESSION['current-profile']['posts']);
		foreach ($dates as $date) {
			foreach ($posts as $post) {
				if ($post['timestamp'] === $date) {
					$_SESSION['current-profile']['posts'][] = 
					[
						'post_id' => $post['post_id'],
						'image' => $post['image'],
						'username' => $post['username'],
						'user_id' => $post['user_id'],
						'timestamp' => $date,
						'caption' => $post['caption'],
						'likes' => $post['likes'],
						'is_liked' => $post['is_liked']
					];
				}
			}
		}
	}
	
	redirect('../follows/loadProfile.php');
}





?>
