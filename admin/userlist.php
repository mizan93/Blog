<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        if (isset($_GET['delet_userid'])) {
            $delid = $_GET['delet_userid'];
            $delquery = "DELETE FROM user_tbl WHERE id='$delid'";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo '<span class="error">User Deleted succesfully!</span>';
            } else {
                echo '<span class="error">User Not Deleted !</span>';
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th> Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>User Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM user_tbl ORDER BY id DESC";
                    $users = $db->select($query);
                    if ($users) {
                        $i = 0;
                        while ($result = $users->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo   $i; ?></td>
                                <td><?php echo   $result['name']; ?></td>
                                <td><?php echo   $result['username']; ?></td>
                                <td><?php echo   $result['email']; ?></td>
                                <td><?php echo   $format->Readmore($result['details'], 30); ?></td>
                                <td><?php
                                    if ($result['role'] == 0) {
                                        echo  'Admin';
                                    } elseif ($result['role'] == 1) {
                                        echo  'Author';
                                    } elseif ($result['role'] == 2) {
                                        echo  'Editor';
                                    }
                                    ?></td>

                                <td>
                                    <a href="viewuser.php?view_userid=<?php echo   $result['id']; ?>">View</a>

                                    <?php
                                    if (Session::get('userRole') == 0) {

                                    ?>
                                        ||<a onclick="return confirm('Are you sure to delete?? ');" href="?delet_userid=<?php echo   $result['id']; ?>">Delete</a></td>
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