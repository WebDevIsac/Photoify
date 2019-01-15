<?php require __DIR__.'/views/header.php'; 

	unset($_SESSION['like_post_id']); 
	if (isset($_SESSION['current-profile'])) {$user = $_SESSION['current-profile'];
		if ($user['user_id'] == $_SESSION['user']['user_id']) {
			$myProfile = true;
			$buttonText = 'Edit Profile'; 
		} else {
			$buttonText = 'Send Message'; 
		}

		if (isset($user['posts'])) {
			$postsCount = count($user['posts']);
		} else {
			$postsCount = 0;
		}
		if (isset($user['followers'])) {
			$followersCount = count($user['followers']);
		} else {
			$followersCount = 0;
		}
		if (isset($user['following'])) {
			$followingCount = count($user['following']);
		} else {
			$followingCount = 0;
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
		<div class="user-counts">
			<div class="posts">
				<h3>Posts</h3>
				<h3><?php echo $postsCount; ?></h3>
			</div>
			<div class="followers">
				<a href="followers.php">
					<h3>Followers</h3>
					<h3><?php echo $followersCount; ?></h3>
				</a>
			</div>
			<div class="following">
				<a href="following.php">
					<h3>Following</h3>
					<h3><?php echo $followingCount; ?></h3>
				</a>
			</div>			
		</div>
	</div>



	<div class="feed">
		<?php 
		foreach ($_SESSION['current-profile']['posts'] as $post): 
			if ($post['is_liked']) { $likeButtonText = 'Unlike'; }
			else { $likeButtonText = 'Like'; }
		?>
		<div class="post" id="<?php echo $post['post_id']; ?>">
			<div class="user-container">
				<div class="user-info">
					<img class="profile-picture" src="assets/images/profile-pictures/<?php echo $user['profile_pic']; ?>" alt="">
					<p><?php echo $user['username']; ?></p>
				</div>
				<?php if (isset($myProfile)): ?>
				<div class="edit-container"></div>
					<a href="" class="edit-button">Edit</a>
					<a href="app/posts/delete.php?delete=<?php echo $post['post_id'] . ' ' . $post['user_id']; ?>" class="delete-button">Delete</a>
				</div>
				<?php endif; ?>
			</div>
			<div class="image-container">
				<img class="image" src="assets/posts/<?php echo $post['photo_url']; ?>" alt="">
			</div>
			<div class="text-container">
				<p class="like-info"><?php echo $likeButtonText ?></p>
				<a href="app/posts/loadProfile.php?post=<?php echo $post['post_id']; ?>" class="like-button"><?php echo $post['likes']; ?></a>
				<p class="date"><?php echo $post['timestamp']; ?></p>
				<p class="caption"><?php echo $post['caption']; ?></p>
			</div>
		</div> <!-- profile-post -->
		<?php endforeach; ?>
	</div> <!-- profile-feed -->

<?php require __DIR__.'/views/footer.php'; ?>
