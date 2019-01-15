<?php 

require __DIR__.'/../autoload.php';

$delete = explode(" ", filter_var($_GET['delete'], FILTER_SANITIZE_STRING));

$postId = (int)$delete[0];
$userId = (int)$delete[1];
$loggerInUser = $_SESSION['user']['user_id'];

if ($userId === $loggerInUser) {
	$deletePost = $pdo -> prepare('DELETE FROM posts WHERE post_id = :post_id AND user_id = :user_id');
	$deletePost -> bindParam(':post_id', $postId, PDO::PARAM_INT);
	$deletePost -> bindParam(':user_id', $loggerInUser, PDO::PARAM_INT);
	$deletePost -> execute();

	redirect('loadProfile.php');
}
