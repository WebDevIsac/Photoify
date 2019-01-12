<?php require __DIR__.'/views/header.php'; ?>

<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	} 
?>

<div class="container">

	<div class="feed">
		<?php 
		foreach ($_SESSION['posts'] as $posts): 
		?>
			<div class="post">
				<div class="user-container">
					<form action="profile.php" method="get">
						<input type="hidden" id="current-pofile" name="current-pofile" value="<?php echo $posts['user_id']; ?>">
						<div class="submit-container" onClick="javascript:this.parentNode.submit()">
							<img class="profile-image" src="<?php echo $posts['username']; ?>" alt="">
							<p><?php echo $posts['username']; ?></p>
						</div>
					</form>
				</div>
				<div class="image-container">
					<img class="image" src="assets/posts/<?php echo $posts['photo_url']; ?>" alt="">
				</div>
				<div class="text-container">
					<p class="likes"><?php echo $posts['likes']; ?></p>
					<p class="date"><?php echo $posts['timestamp']; ?></p>
					<p class="caption"><?php echo $posts['caption']; ?></p>
				</div>
			</div> <!-- post -->
		<?php
			endforeach; 
		?>
</div> <!-- feed -->

	<a href="app/users/logout.php" class="logout">Logout</a>

</div> <!-- container -->
	
<?php require __DIR__.'/views/footer.php'; ?>
