<?php require __DIR__.'/views/header.php'; 

	unset($_SESSION['like_post_id']); 
	if (isset($_SESSION['current-profile'])) { 
		$user = $_SESSION['current-profile'];
		$userID = $user['user_id'];
		if ($user['user_id'] == $_SESSION['user']['user_id']) {
			$myProfile = true;
			$buttonText = 'Edit Profile';
			$buttonLink = 'edit-profile.php'; 
		} else if (isset($_SESSION['following'])) {
			foreach ($_SESSION['following'] as $follow) {
				$buttonLink = "app/follows/update.php?user=$userID";
				if ($follow['user_id'] == $user['user_id']) {
					$buttonText = 'Unfollow';
				} else {
					$buttonText = 'Follow'; 
				}
			}
		} else {
			$buttonText = 'Follow';
			$buttonLink = "app/follows/update.php?user=$userID";
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
		<h3><?php echo $user['username']; ?></h3>
		<img src="assets/images/profile-pictures/<?php echo $user['profile_image']; ?>" alt="">
		<div class="user-button"><a href="<?php echo $buttonLink; ?>"><?php echo $buttonText; ?></a></div>
		<div class="bio">
			<p><?php echo $user['bio']; ?></p>
		</div>
		<div class="user-counts">
			<div class="posts">
				<a>
					<h3>Posts</h3>
					<h3><?php echo $postsCount; ?></h3>
				</a>
			</div>
			<div class="followers">
				<a>
					<h3>Followers</h3>
					<h3><?php echo $followersCount; ?></h3>
				</a>
			</div>
			<div class="following">
				<a>
					<h3>Following</h3>
					<h3><?php echo $followingCount; ?></h3>
				</a>
			</div>			
		</div>
	</div>



	<div class="feed">
		<?php 
		if (isset($user['posts'])):
		foreach ($user['posts'] as $post): 
			if ($post['is_liked']) { $likeButtonText = 'Unlike'; }
			else { $likeButtonText = 'Like'; }
		?>
		<div class="post" id="<?php echo $post['post_id']; ?>">
			<div class="user-container">
				<div class="user-info">
					<img class="profile-picture" src="assets/images/profile-pictures/<?php echo $user['profile_image']; ?>" alt="">
					<p><?php echo $user['username']; ?></p>
				</div> <!-- user-info -->
				<?php if (isset($myProfile)): ?>
				<div class="edit-container">
					<a href="edit-post.php?edit=<?php echo $post['post_id']; ?>" class="edit-button">Edit</a>
					<a href="app/posts/delete.php?delete=<?php echo $post['post_id'] . ' ' . $post['user_id'] . ' ' . $post['image']; ?>" class="delete-button">Delete</a>
				</div> <!-- edit-container -->
				<?php endif; ?>
			</div> <!-- user-container -->
			<div class="image-container">
				<img class="image" src="assets/posts/<?php echo $post['image']; ?>" alt="">
			</div> <!-- image-container -->
			<div class="text-container">
				<p class="like-info"><?php echo $likeButtonText ?></p>
				<a href="app/posts/loadProfile.php?post=<?php echo $post['post_id']; ?>" class="like-button"><?php echo $post['likes']; ?></a>
				<p class="date"><?php echo $post['timestamp']; ?></p>
				<p class="caption"><?php echo $post['caption']; ?></p>
			</div> <!-- image-container -->
		</div> <!-- profile-post -->
		<?php endforeach; ?>
	</div> <!-- profile-feed -->
	<?php else: ?>
	<h1>No posts uploaded</h1>
	<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
