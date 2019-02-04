<?php require __DIR__.'/views/header.php'; ?>

<form class="upload-form" action="app/posts/store.php" method="post" enctype="multipart/form-data">
	<img src="assets/images/svg-images/no-image.svg" class="upload-image" title="Choose image">
	<input type="file" accept="image/*" name="image" class="upload-input" onchange="uploadFile(event)">
	<?php if (isset($_SESSION['file-error'])): ?>
	<h3>Error: <?php echo $_SESSION['file-error']; ?></h3>
	<?php endif; ?>
	<div class="caption-container">
		<label for="caption">Caption</label>
		<textarea class="caption-input" name="caption" id="caption" cols="20" rows="10"></textarea>
	</div>
	<button type="submit">Upload</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>
