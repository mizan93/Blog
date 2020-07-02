<?php include 'inc/header.php'; ?>

<?php
if (!isset($_GET['id']) || $_GET['id'] == null) {
	header('Loacation: 404.php');
} else {
	$id = $_GET['id'];
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			$query = "SELECT * FROM post_tbl WHERE id=$id";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {


			?>
					<h2><?php echo $result['title']; ?></h2>
					<h4><?php echo $result['date']; ?>,written By <?php echo $result['author']; ?></h4>
					<img src="admin/<?php echo $result['image']; ?>" alt="Post Image" />
					<?php echo $result['body']; ?>

					<div class="relatedpost clear">
						<h2>Related articles</h2>
						<?php
						$catid = $result['category'];
						$queryrelted = "SELECT * FROM post_tbl WHERE category='$catid' ORDER BY RAND() LIMIT 6";
						$retaltedpost = $db->select($queryrelted);
						if ($retaltedpost) {
							while ($rresult = $retaltedpost->fetch_assoc()) {


						?>
								<a href="post.php?id=<?php echo $rresult['id']; ?>"><img src="admin/<?php echo $rresult['image']; ?>" alt="related post image"></a>
						<?php }
						} else {
							echo 'No related post available !!';
						} ?>
					</div>

			<?php
				}
			} else {
				header('Location: 404.php');
			} ?>
		</div>

	</div>


<?php include 'inc/sidebar.php'; ?>

<?php include 'inc/footer.php'; ?>