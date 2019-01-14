<?php require __DIR__.'/views/header.php'; ?>

<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	}

	?>

<div class="feed">
	<?php 
	$filePath = 'assets/images/profile-pictures/';
	
	foreach ($_SESSION['posts'] as $post): 
		if ($post['is_liked']) { $likeButtonText = 'Unlike'; }
		else { $likeButtonText = 'Like'; }

	?>
		<div class="post" id="<?php echo $post['post_id']; ?>">
			<div class="user-container">
				<form action="app/users/load.php" method="get">
					<input type="hidden" id="current-profile" name="current-profile" value="<?php echo $post['user_id']; ?>">
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
				<div class="like-container">
					<p class="likes"><?php echo $post['likes']; ?> likes</p>
					<a href="app/posts/updateLike.php?post=<?php echo $post['post_id']; ?>" class="like-button"><?php echo $likeButtonText; ?></a>
				</div>
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
