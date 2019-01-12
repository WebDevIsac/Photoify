<?php 

require __DIR__.'/../autoload.php';

if (isset($_GET['current-profile'])) {
	$loadUser = $pdo -> prepare('SELECT username FROM users WHERE user_id = :user_id');
	$loadUser -> bindParam(':user_id', $_GET['current-profile'], PDO::PARAM_INT);
	$loadUser -> execute();
	$loadUser = $loadUser -> fetchAll(PDO::FETCH_ASSOC);
}






?>
