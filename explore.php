<?php require __DIR__.'/views/header.php' ?>


<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	}
	if (isset($_SESSION['all_posts'])):
	?>

<div class="feed">
	<?php 
	foreach ($_SESSION['all_posts'] as $post): 
		if ($post['is_liked']) { $likeButtonText = 'Unlike'; }
		else { $likeButtonText = 'Like'; }
		?>

		<div class="post" id="<?php echo $post['post_id']; ?>">
			<div class="user-container">
				<a class="user-info" href="app/users/load.php?current-profile=<?php echo $post['user_id']; ?>">
					<img class="profile-picture" src="assets/images/profile-pictures/<?php echo $post['profile_image']; ?>" alt="">
					<p><?php echo $post['username']; ?></p>
				</a>
			</div>
			<div class="image-container">
				<img class="image" src="assets/posts/<?php echo $post['image']; ?>" alt="">
			</div>
			<div class="text-container">
				<p class="like-info"><?php echo $likeButtonText ?></p>
				<a href="app/posts/updateLike.php?post=<?php echo $post['post_id']; ?>" class="like-button"><?php echo $post['likes']; ?></a>
				<p class="date"><?php echo $post['timestamp']; ?></p>
				<p class="caption"><?php echo $post['caption']; ?></p>
			</div>
		</div> <!-- post -->
	<?php endforeach; ?>
</div> <!-- feed -->
	<?php else: ?>
	<h1>No posts uploaded</h1>
	<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>


<?php require __DIR__.'/views/footer.php' ?>
