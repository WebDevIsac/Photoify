</div> <!-- container -->


<?php if (isset($_SESSION['user'])): ?>
<footer>
		<ul class="nav-bar">
			<li class="nav-item">
				<a href="../app/follows/load.php" class="nav-link"><img src="assets/images/svg-images/home-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="app/posts/loadAllPosts.php" class="nav-link"><img src="assets/images/svg-images/search-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="../add.php" class="nav-link"><img src="assets/images/svg-images/camera-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="app/users/load.php?current-profile=<?php echo $_SESSION['user']['user_id']; ?>">
					<img src="assets/images/svg-images/avatar-50px.svg" alt="">
				</a>
			</li>
			<li class="nav-item">
				<a href="../app/users/logout.php">
					<img src="../assets/images/svg-images/logout.svg" alt="">
				</a>
			</li>
		</ul>
	</footer>
<?php endif; ?>

<script src="assets/script/script.js"></script>
</body>
</html>
