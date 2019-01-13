<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_SESSION['current-profile'])) {
	$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
	$loadPosts -> bindParam(':user_id', $_SESSION['current-profile']['user_id'], PDO::PARAM_INT);
	$loadPosts -> execute();
	$loadPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);
	foreach ($loadPosts as $loadPost) {
		$posts[] = $loadPost;
		$dates[] = $loadPost['timestamp'];
	}
	rsort($dates);
	foreach ($dates as $date) {
		foreach ($posts as $post) {
			if ($post['timestamp'] === $date) {
				$_SESSION['current-profile']['posts'][] = 
				[
					'photo_url' => $post['photo_url'],
					'username' => $post['username'],
					'timestamp' => $date,
					'caption' => $post['caption'],
					'likes' => $post['likes']
				];
			}
		}
	}

	redirect('../../profile.php');
}





?>
