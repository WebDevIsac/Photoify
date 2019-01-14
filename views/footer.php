</div> <!-- container -->


<footer>
<?php if (isset($_SESSION['user'])): ?>
		<ul class="nav-bar">
			<li class="nav-item">
				<a href="../app/follows/load.php" class="nav-link"><img src="assets/images/svg-images/home-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="search.php" class="nav-link"><img src="assets/images/svg-images/search-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="../add.php" class="nav-link"><img src="assets/images/svg-images/camera-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="news.php" class="nav-link"><img src="assets/images/svg-images/news-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<form action="app/users/load.php" method="get">
					<input type="hidden" id="current-profile" name="current-profile" value="<?php echo $_SESSION['user']['user_id']; ?>">
					<img src="assets/images/svg-images/avatar-50px.svg" alt="" onClick="javascript:this.parentNode.submit()">
				</form>	
			</li>
		</ul>
	<?php elseif ($_SERVER['PHP_SELF'] === '/explore.php'): ?>
	<h1>Back to login page</h1>
	<?php else: ?>
		<a href="explore.php">Explore</a>
	<?php endif; ?>
</footer>

<script src="assets/script/script.js"></script>
</body>
</html>
