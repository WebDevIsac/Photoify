<?php 

if (isset($_SESSION['user'])) {
	$loadStatement = $pdo -> query('SELECT * FROM photo');
	$posts = $loadStatement -> fetchAll(PDO::FETCH_ASSOC);
}






?>
