<?php 

require __DIR__.'/../autoload.php';

$userID = $_SESSION['user']['user_id'];
$followID = $_POST['follow_id'];

$storeFollowing = $pdo -> prepare('INSERT INTO following(user_id, follow_id) VALUES(:user_id, :follow_id)');

$storeFollowing -> bindParam(':user_id', $userID, PDO::PARAM_INT);
$storeFollowing -> bindParam(':follow_id', $followID, PDO::PARAM_INT);

$storeFollowing -> execute();

$storeFollowers = $pdo -> prepare('INSERT INTO followers(user_id, follower_id) VALUES(:user_id, :follower_id)');

$storeFollowers -> bindParam(':userId', $followID, PDO::PARAM_INT);
$storeFollowers -> bindParam(':follower_Id', $userID, PDO::PARAM_INT);

$storeFollowers -> execute();

redirect('../../profile.php');

?>
