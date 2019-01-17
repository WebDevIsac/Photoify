<?php 

require __DIR__.'/../autoload.php';

$delete = explode(" ", filter_var($_GET['delete'], FILTER_SANITIZE_STRING));

$postID = (int)$delete[0];
$userID = (int)$delete[1];
$imageURL = $delete[2];
$imagePath = __DIR__.'/../../assets/posts/' . $imageURL;
$loggedInUser = $_SESSION['user']['user_id'];

if ($userID == $loggedInUser) {
	$deletePost = $pdo -> prepare('DELETE FROM posts WHERE post_id = :post_id AND user_id = :user_id');
	$deletePost -> bindParam(':post_id', $postID, PDO::PARAM_INT);
	$deletePost -> bindParam(':user_id', $loggedInUser, PDO::PARAM_INT);
	$deletePost -> execute();

	if (is_file($imagePath))
	{
		unlink($imagePath);
	}
	
	redirect("../users/load.php?current-profile=$userID.php");
}
