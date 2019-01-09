<?php 

require __DIR__.'/../autoload.php';

$images = $_FILES['photo'];
$type = $images['type'];
$size = $images['size'];
if ($type !== 'image/jpeg' && $type !== 'image/gif' && $type !== 'image/png') {
	echo 'Wrong file format';
	die;
} else if ($size > 3 * MB) {
	echo 'File to big';
	die;
}

$photoUrl = __DIR__.'/../../assets/posts/' . uniqid() . "-$date-" . $images['name'];

move_uploaded_file($images['tmp_name'], $photoUrl);

$userID = $_SESSION['user']['id'];
$caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING);

$storePost = $pdo -> prepare("INSERT INTO photo(user_id, photo_url, caption, timestamp) VALUES(:user_id, :photo_url, :caption, DateTime('now'))");

if (!$storePost) {
	die(var_dump($pdo->errorInfo()));
}

$storePost -> bindParam(':user_id', $userID, PDO::PARAM_INT);
$storePost -> bindParam(':photo_url', $photoUrl, PDO::PARAM_STR);
$storePost -> bindParam(':caption', $caption, PDO::PARAM_STR);

$storePost -> execute();

redirect('../../index.php');





?>
