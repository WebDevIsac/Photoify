<?php require __DIR__.'/views/header.php'; ?>

<form class="add-form" action="app/posts/store.php" method="post" enctype="multipart/form-data">
	<input type="file" name="photo" class="image">
	<input type="text" name="caption" id="caption">
	<button type="submit">Upload</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>
