<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <?php
        if (isset($_GET['del_slide_id'])) {
            $delid = $_GET['del_slide_id'];
            $delquery = "DELETE FROM slider WHERE id='$del vv0 id'";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo '<span class="error">Slider  Deleted succesfully!</span>';
            } else {
                echo '<span class="error">Slider Not Deleted !</span>';
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="15%">Post Title</th>
                        <th width="10%">Image</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT  *  FROM slider 
			ORDER BY id DESC
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


                                <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" alt=""></td>



                                <td>

                                    <?php if (Session::get('userRole') == 0) {
                                    ?>
                                        <a href="editslider.php?slide_id=<?php echo $result['id']; ?>">Edit</a>||

                                        <a onclick="return confirm('Are you sure to delete??');" href="?del_slide_id=<?php echo $result['id']; ?>">Delete</a></td>
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