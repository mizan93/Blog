<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
        if (isset($_GET['delet_catid'])) {
           $delid= $_GET['delet_catid'];
           $delquery= "DELETE FROM category_tbl WHERE id='$delid'";
           $deldata=$db->delete($delquery);
           if ($deldata) {
                echo '<span class="error">Category Deleted succesfully!</span>';
           }else{
                echo '<span class="error">Category Not Deleted !</span>';

           }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM category_tbl ORDER BY id DESC";
                    $category = $db->select($query);
                    if ($category) {
                        $i = 0;
                        while ($result = $category->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo   $i; ?></td>
                                <td><?php echo   $result['name']; ?></td>
                                <?php  if (Session::get('userRole')==0) {
                                  
                                ?>
                                <td><a href="editcat.php?edit_catid=<?php echo   $result['id']; ?>">Edit</a> || 
                                <a onclick="return confirm('Are you sure to delete?? ');"
                                 href="?delet_catid=<?php echo   $result['id']; ?>">Delete</a></td>
                            <?php } ?>
                                </tr>
                    <?php }
                    } else {
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
<?php include 'inc/footer.php' ?>