<?php require __DIR__.'/views/header.php'; ?>

<?php
$postID = $_GET['edit'];
foreach ($_SESSION['current-profile']['posts'] as $post):
	if ($post['post_id'] == $_GET['edit']):
?>
	<form class="edit-post-form" action="app/posts/update.php?post=<?php echo $post['post_id']; ?>" method="post" enctype="multipart/form-data">
		<img src="assets/posts/<?php echo $post['image']; ?>" class="post-image" alt="">
		<label for="caption">Caption</label>
		<textarea class="caption-input" name="caption" id="caption" cols="20" rows="10"><?php echo $post['caption']; ?></textarea>
		<button type="submit">Done</button>
	</form>

<?php 
	endif;
endforeach;
?>

<?php require __DIR__.'/views/footer.php'; ?>
