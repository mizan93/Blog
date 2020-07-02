<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>



<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<!-- pagination-->


		<div class="samepost clear">
			<?php
			$per_page = 3;
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			$start_from = ($page - 1) * $per_page;

			?>
			<!-- pagination-->

			<?php
			$query = "SELECT * FROM post_tbl LIMIT $start_from, $per_page";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {


			?>

					<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
					<h4><?php echo $format->formatDate($result['date']); ?> Written by <a href="#"><?php echo  $result['author']; ?></a></h4>
					<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>
					<?php echo $format->Readmore($result['body']); ?>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
					</div>


				<?php } ?>
				<!-- End while loop-->


				<!-- pagination-->
				<?php
				$query = "SELECT * FROM post_tbl ";
				$result = $db->select($query);
				$total_rows = mysqli_num_rows($result);
				$total_page = ceil($total_rows / $per_page);

				echo '<span class="pagination" ><a href="indext.php?page=1 ">First page</a>' ?>
				<?php
				for ($i = 1; $i <= $total_page; $i++) {
					echo  '<a href="Home.php?page=' . $i . '">' . $i . '</a>';
				} ?>
				<?php echo "<a href='Home.php?page=" . $total_page . " '>Last page</a></span>" ?>
				<!-- pagination-->

			<?php } else {
				header('Location: 404.php');
			} ?>
			<!-- End ifelse -->
		</div>
	</div>
	<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>