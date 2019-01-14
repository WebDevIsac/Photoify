<?php require __DIR__.'/views/header.php'; 

	if ($_SESSION['current-profile']) {$user = $_SESSION['current-profile']; 
		if ($_SESSION['current-profile']['user_id'] === $_SESSION['user']['user_id']) {
			$buttonText = 'Edit Profile'; 
		} else {
			$buttonText = 'Send Message'; 
		}
	}

?>
	
	<div class="profile-container">
		<img src="assets/images/profile-pictures/<?php echo $user['profile_pic']; ?>" alt="">
		<h3><?php echo $user['username']; ?></h3>
		<div class="user-button"><?php echo $buttonText; ?></div>
		<div class="bio">
			<p><?php echo $user['caption']; ?></p>
		</div>
		<div class="info">
			<div class="posts">
				
			</div>
			<div class="followers"></div>
			<div class="following"></div>
		</div>
	</div>



	<div class="feed">
		<?php foreach ($_SESSION['current-profile']['posts'] as $post): ?>
		<div class="post">
			<div class="user-container">
				<div class="user-info">
					<img class="profile-picture" src="assets/images/profile-pictures/<?php echo $user['profile_pic']; ?>" alt="">
					<p><?php echo $user['username']; ?></p>
				</div>
				</form>
			</div>
			<div class="image-container">
				<img class="image" src="assets/posts/<?php echo $post['photo_url']; ?>" alt="">
			</div>
			<div class="text-container">
				<p class="likes"><?php echo $post['likes']; ?></p>
				<p class="date"><?php echo $post['timestamp']; ?></p>
				<p class="caption"><?php echo $post['caption']; ?></p>
			</div>
		</div> <!-- profile-post -->
		<?php endforeach; ?>
	</div> <!-- profile-feed -->




<?php require __DIR__.'/views/footer.php'; ?>
