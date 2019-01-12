<?php require __DIR__.'/views/header.php'; ?>

<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	} 
	?>

<div class="feed">
	<?php 
	foreach ($_SESSION['posts'] as $post): 
		$filePath = 'assets/images/profile-pictures/';

	?>
		<div class="post">
			<div class="user-container">
				<form action="app/users/load.php" method="get">
					<input type="hidden" id="current-profile" name="current-profile" value="<?php echo $post['username']; ?>">
					<div class="user-info" onClick="javascript:this.parentNode.submit()">
						<img class="profile-picture" src="assets/images/profile-pictures/<?php echo $post['profile_pic']; ?>" alt="">
						<p><?php echo $post['username']; ?></p>
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
		</div> <!-- post -->
	<?php
		endforeach; 
	?>
</div> <!-- feed -->

<a href="app/users/logout.php" class="logout">Logout</a>

<?php require __DIR__.'/views/footer.php'; ?>
