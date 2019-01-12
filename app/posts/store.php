<?php 

require __DIR__.'/../autoload.php';
$image = $_FILES['photo'];
$type = $image['type'];
$size = $image['size'];
if ($type !== 'image/jpeg' && $type !== 'image/gif' && $type !== 'image/png') {
	echo 'Wrong file format';
	die;
} else if ($size > 3 * MB) {
	echo 'File to big';
	die;
}

$photoPath = __DIR__.'/../../assets/posts/';
$photoName =  uniqid() . "-$date-" . $image['name'];

move_uploaded_file($image['tmp_name'], $photoPath . $photoName);

$userId = $_SESSION['user']['user_id'];
$caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING);

$storePost = $pdo -> prepare("INSERT INTO posts(user_id, photo_url, caption, timestamp) VALUES(:user_id, :photo_url, :caption, DateTime('now'))");

if (!$storePost) {
	die(var_dump($pdo->errorInfo()));
}

$storePost -> bindParam(':user_id', $userId, PDO::PARAM_INT);
$storePost -> bindParam(':photo_url', $photoName, PDO::PARAM_STR);
$storePost -> bindParam(':caption', $caption, PDO::PARAM_STR);

$storePost -> execute();

redirect('../../index.php');





?>
