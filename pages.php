<?php include 'inc/header.php'; ?>

<?php
if (!isset($_GET['page_id']) || $_GET['page_id'] == null) {
	header('location:404.php');
	// echo "<script>window.location='catlist.php';</script>";
} else {
	$getid = $_GET['page_id'];
}
?>
<div class="contentsection contemplete clear">

	<?php
	$query = "SELECT * FROM page WHERE id='$getid '";
	$pages = $db->select($query);
	if ($pages) {

		while ($result = $pages->fetch_assoc()) {

	?>

			<div class="maincontent clear">
				<div class="about">

					<h2><?php echo $result['name'] ?></h2>


					<?php echo $result['body'] ?>



			<?php }
	} else {
		header('location:404.php');
	} ?>
		</div>

	</div>

	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>