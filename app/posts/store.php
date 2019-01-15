<?php 

require __DIR__.'/../autoload.php';
$image = $_FILES['image'];
$type = $image['type'];
$size = $image['size'];

unset($_SESSION['file-error']);

if ($type !== 'image/jpeg' && $type !== 'image/jpg' && $type !== 'image/gif' && $type !== 'image/png') 
{
	$_SESSION['file-error'] = 'Wrong file format';
	redirect('../../add.php');
} 
else if ($size > 5 * MB) 
{
	$_SESSION['file-error'] = 'File to big';
	redirect('../../add.php');
}

$imagePath = __DIR__.'/../../assets/posts/';
$imageName =  uniqid() . "-$date-" . $image['name'];

move_uploaded_file($image['tmp_name'], $imagePath . $imageName);

$userId = $_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];
$caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING);

$storePost = $pdo -> prepare("INSERT INTO posts(user_id, photo_url, caption, username, timestamp) VALUES(:user_id, :photo_url, :caption, :username, DateTime('now'))");

$storePost -> bindParam(':user_id', $userId, PDO::PARAM_INT);
$storePost -> bindParam(':photo_url', $imageName, PDO::PARAM_STR);
$storePost -> bindParam(':caption', $caption, PDO::PARAM_STR);
$storePost -> bindParam(':username', $username, PDO::PARAM_STR);

$storePost -> execute();

redirect('../../index.php');





?>
