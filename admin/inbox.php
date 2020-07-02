﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($_GET['del_id'])) {
            $delid = $_GET['del_id'];
            $delquery = "DELETE FROM contact WHERE id='$delid'";
            $deldata = $db->delete($delquery);
            if ($deldata) {
                echo '<span class="error">Message Deleted succesfully!</span>';
            } else {
                echo '<span class="error">Message Not Deleted !</span>';
            }
        }
        ?>
        <?php

        if (isset($_GET['seen_id'])) {
            $seenid = $_GET['seen_id'];
            $query = "UPDATE contact SET
                     status='1'
                     WHERE id='$seenid' ";
            $updated = $db->update($query);
            if ($updated) {
                echo '<span class="success">Message sent in the seen Box succesfully!</span>';
            } else {
                echo '<span class="error">Category not Updated !</span>';
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM contact WHERE status=0 ORDER BY id DESC";
                    $DATA = $db->select($query);
                    if ($DATA) {
                        $i = 0;
                        while ($result = $DATA->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $format->Readmore($result['body'], 30); ?></td>
                                <td><?php echo ($result['datetime']); ?></td>


                                <td>
                                    <a href="viewmsg.php?v_id=<?php echo $result['id']; ?>">View</a>|
                                    <a href="replymsg.php?r_id=<?php echo $result['id']; ?>">Reply</a>|
                                    <a onclick="return confirm('Are you sure to move this  Message?? ');" href="?seen_id=<?php echo $result['id']; ?>">Seen</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM contact WHERE status=1 ORDER BY id DESC";
                    $DATA = $db->select($query);
                    if ($DATA) {
                        $i = 0;
                        while ($result = $DATA->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $format->Readmore($result['body'], 30); ?></td>
                                <td><?php echo ($result['datetime']); ?></td>


                                <td> <a href="viewmsg.php?v_id=<?php echo $result['id']; ?>">View</a>|

                                    <a onclick="return confirm('Are you sure to delete?? ');" href="?del_id=<?php echo $result['id']; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php }
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
<?php include 'inc/footer.php'; ?>