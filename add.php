<?php require __DIR__.'/views/header.php'; ?>

<form class="add-form" action="app/posts/store.php" method="post" enctype="multipart/form-data">
	<h1>Upload Post</h1>
	<img src="assets/images/profile-pictures/avatar.jpg" class="upload-image" alt="">
	<input type="file" accept="image/*" name="image" class="upload-input" onchange="uploadFile(event)">
	<label for="caption">Caption</label>
	<textarea class="caption-input" name="caption" id="caption" cols="30" rows="10"></textarea>
	<button type="submit">Upload</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>
