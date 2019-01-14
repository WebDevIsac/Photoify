<?php 

require __DIR__.'/../autoload.php';

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
}

redirect('load.php');


?>
