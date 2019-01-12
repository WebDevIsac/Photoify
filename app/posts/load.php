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
							'photo_url' => $post['photo_url'],
							'username' => $post['username'],
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

	redirect('../../index.php');
}

?>
