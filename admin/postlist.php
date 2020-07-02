<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No.</th>
						<th width="15%">Post Title</th>
						<th width="20%">Description</th>
						<th width="10%">Category</th>
						<th width="10%">Image</th>
						<th width="10%">Author</th>
						<th width="10%">Tags</th>
						<th width="10%">Date</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$query = "SELECT  post_tbl.*, category_tbl.name FROM post_tbl 
			INNER JOIN category_tbl
			ON post_tbl.category=category_tbl.id
			ORDER BY post_tbl.title DESC
			";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result = $post->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['title']; ?></td>
								<td><?php echo $format->Readmore($result['body'], 50); ?></td>

								<td class="center"> <?php echo $result['name']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" alt=""></td>
								<td><?php echo $result['author']; ?></td>

								<td><?php echo $result['tags']; ?></td>
								<td class="center"> <?php echo $format->formatDate($result['date']); ?></td>
								<td><a href="viewpost.php?viewpost_id=<?php echo $result['id']; ?>">View</a>||

									<?php if (Session::get('userId') == $result['userid'] || Session::get('userRole') == 0) {
									?>
										<a href="editpost.php?edit_id=<?php echo $result['id']; ?>">Edit</a>||

										<a onclick="return confirm('Are you sure to delete??');" href="delpost.php?del_id=<?php echo $result['id']; ?>">Delete</a></td>
							<?php } ?>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<div class=" clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>