<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['following'])) {

	foreach ($_SESSION['following'] as $follow) {

		$loadUsers = $pdo -> prepare('SELECT * FROM users WHERE id = :user_id');
		$loadUsers -> bindParam(':user_id', $follow, PDO::PARAM_INT);
		$loadUsers -> execute();

		$following[] = $loadUsers -> fetchAll(PDO::FETCH_ASSOC);
		
		$loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
		$loadPosts -> bindParam(':user_id', $follow, PDO::PARAM_INT);
		$loadPosts -> execute();
		
		$posts[] = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);
	}

	
	foreach ($posts as $array) {
		foreach ($array as $post) { 
			$allPosts[] = $post;
		}
	}
	
	foreach ($allPosts as $allPost) {
		print_r($allPost);
		echo '<br>';
	}

}

?>
