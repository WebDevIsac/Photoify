<?php 

if (isset($_POST['caption'])) {
	$userID = $_SESSION['user']['id'];
	$caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING);

	
}

$checkStatement = $pdo -> query('SELECT * FROM users');




?>
