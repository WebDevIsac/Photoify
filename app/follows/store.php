<?php 

require __DIR__.'/../autoload.php';

$userId = $_SESSION['user']['id'];
$followId = $_POST['follow_id'];

$storeFollowing = $pdo -> prepare('INSERT INTO following(user_id, follow_id) VALUES(:userId, :followId)');

$storeFollowing = $pdo -> bindParam(':userId', $userId, PDO::PARAM_INT);
$storeFollowing = $pdo -> bindParam(':followId', $followId, PDO::PARAM_INT);

$storeFollowing -> execute();

$storeFollowers = $pdo -> prepare('INSERT INTO followers(user_id, follow_id) VALUES(:userId, :followId)');


?>
