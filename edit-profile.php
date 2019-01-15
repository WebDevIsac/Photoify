<?php require __DIR__.'/views/header.php'; ?>

<form class="edit-profile-form" action="app/users/edit.php" method="post" enctype="multipart/form-data">
	<h1>Edit Profile</h1>
	<img src="assets/images/profile-pictures/<?php echo $_SESSION['user']['profile_pic']; ?>" class="upload-image" alt="">
	<input type="file" accept="image/*" name="image" class="upload-input" onchange="changeFile(event)">
	<div class="email">
		<label for="email">Change your email</label>
		<input type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>">
	</div>
	<div class="password">
		<label for="old-password">Enter current password</label>
		<input type="password" name="old-password" id="old-password">
		<label for="password">Enter new password</label>
		<input type="password" name="new-password" id="new-password">
	</div>
	<label for="bio">Your biography</label>
	<textarea class="bio-input" name="bio" id="bio" cols="30" rows="10"><?php echo $_SESSION['user']['bio']; ?></textarea>
	<button type="submit">Save</button>
</form>
<?php require __DIR__.'/views/footer.php'; ?>
