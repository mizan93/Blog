<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
$userid = Session::get('userId');
$userrole = Session::get('userRole');
?>
<?php
if (isset($_GET['view_userid']) && $_GET['view_userid'] == null) {
    header('location: userlist.php');
} else {
    $getid = $_GET['view_userid'];
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>User Details</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                 echo " <script>window.location = 'userlist.php';</script>";
        }

        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM user_tbl WHERE id='$getid' ORDER BY id DESC";
            $getuser = $db->select($query);
            if ($getuser) {

                while ($result = $getuser->fetch_assoc()) {

            ?>
                    <form action="" method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input readonly name="name" type="text" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input readonly name="username" type="text" value="<?php echo $result['username']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input readonly name="email" type="text" value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea readonly name="details" class="tinymce">

                                <?php echo $result['details']; ?>
                                </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>

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