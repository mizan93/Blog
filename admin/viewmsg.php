<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['v_id']) || $_GET['v_id'] == null) {
    header('location:inbox.php');
    // echo "<script>window.location='inbox.php';</script>";
} else {
    $getid = $_GET['v_id'];
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     echo "<script>window.location = 'inbox.php';</script>";
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <?php
                $query = "SELECT * FROM contact WHERE id='$getid' ORDER BY id DESC";
                $DATA = $db->select($query);
                if ($DATA) {
                    $i = 0;
                    while ($result = $DATA->fetch_assoc()) {
                        $i++;

                ?>
                        <table class="form">

                            <tr>
                                <td>
                                    <label>name</label>
                                </td>
                                <td>
                                    <input name="name" readonly type="text" value="<?php echo $result['firstname'] . ' ' . $result['lastname']; ?> " class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input name="name" readonly type="text" value="<?php echo $result['email']; ?> " class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Message </label>
                                </td>
                                <td>
                                    <textarea readonly name="body" class="tinymce">
                                       <?php echo $result['body']; ?> 
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input name="name" type="text" value="<?php echo $format->formatDate($result['datetime']); ?> " class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
                                </td>
                            </tr>
                        </table>
                <?php }
                } ?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php' ?>