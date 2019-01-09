<?php 

require __DIR__.'/../autoload.php';

$userId = $_SESSION['user']['id'];
$followId = $_POST['follow_id'];

$storeFollowing = $pdo -> prepare('INSERT INTO following(user_id, follow_id) VALUES(:user_id, :follow_id)');

$storeFollowing -> bindParam(':user_id', $userId, PDO::PARAM_INT);
$storeFollowing -> bindParam(':follow_id', $followId, PDO::PARAM_INT);

$storeFollowing -> execute();

$storeFollowers = $pdo -> prepare('INSERT INTO followers(user_id, follower_id) VALUES(:user_id, :follower_id)');

$storeFollowers -> bindParam('userId', $followId, PDO::PARAM_INT);
$storeFollowers -> bindParam('followerId', $userId, PDO::PARAM_INT);

$storeFollowers -> execute();

redirect('../../profile.php');

?>
