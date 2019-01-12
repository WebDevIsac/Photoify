<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['following'])) {


	foreach ($_SESSION['following'] as $follow) {

		$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
		$loadPosts -> bindParam(':user_id', $follow['follow_id'], PDO::PARAM_INT);
		$loadPosts -> execute();
		$loadPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);

		foreach ($loadPosts as $userPost) {
			$posts[] = $userPost;
		}
	}

	foreach ($posts as $post) {
		$_SESSION['posts'][] = [
			'photo_url' => $post['photo_url'],
			'user_id' => $post['user_id'],
			'username' => $post['username'],
			'timestamp' => $post['timestamp'],
			'caption' => $post['caption'],
			'likes' => $post['likes']
		];
	}

	redirect('../../index.php');
}

?>
