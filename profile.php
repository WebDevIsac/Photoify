<?php require __DIR__.'/views/header.php'; 


	if ($_SESSION['user']['username'] === $_SESSION['current-profile']['username']) {
		$user = $_SESSION['user'];
		$buttonText = 'Edit Profile';
	} else {
		$user = $_SESSION['current-profile'];
		$buttonText = 'Send Message';
	} 
	?>
	
	<div class="profile-container">
		<img src="assets/images/profile-pictures/<?php echo $user['profile_pic']; ?>" alt="">
		<h3><?php echo $user['username']; ?></h3>
		<div class="user-button"><?php echo $buttonText; ?></div>
	</div>



	<div class="profile-feed">
	
	</div>




<?php require __DIR__.'/views/footer.php'; ?>
