<?php require __DIR__.'/views/header.php'; ?>

<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	} 
?>

<div class="container">

	<div class="feed">
		<?php 
			foreach ($_SESSION['posts'] as $posts): ?>
				<div class="post">
					<div class="user-container">
						<img class="profile-image" src="" alt="">
						<p><?php echo $posts['username']; ?></p>
					</div>
					<div class="image-container">
						<img class="image" src="assets/posts/<?php echo $posts['photo_url']; ?>" alt="">
					</div>
					<div class="text-container">
						<p class="likes"></p>
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
