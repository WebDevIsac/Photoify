<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['following'])) {


	foreach ($_SESSION['following'] as $follow) {

		$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
		$loadPosts -> bindParam(':user_id', $follow['follow_id'], PDO::PARAM_INT);
		$loadPosts -> execute();

		$userPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);
		foreach ($userPosts as $userPost) {
			$posts[] = $userPost;
		}
	}

	foreach ($posts as $post) {
		$_SESSION['posts'][] = [
			'user_id' => $post['user_id'],
			'username' => $post['username'],
			'photo_url' => $post['photo_url'],
			'caption' => $post['caption'],
			'timestamp' => $post['timestamp']
		];
	}


	redirect('../../index.php');
}

?>
