<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['r_id']) || $_GET['r_id'] == null) {
    header('location:inbox.php');
    // echo "<script>window.location='inbox.php';</script>";
} else {
    $getid = $_GET['r_id'];
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $to_email = $format->validation($_POST['toEmail']);
            $from_email = $format->validation(($_POST['fromEmail']));
            $subject = $format->validation(($_POST['subject']));
            $message = $format->validation(($_POST['message']));

            $sendmail=mail($to_email,$subject,$message,$from_email);
            if ($sendmail) {
                echo '<span class="success">Messsage sent succesfully.</span>';

            }else{
                echo '<span class="error">Messsage not sent! somethig went wrong.</span>';

            }
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
                    <label>To</label>
                </td>
                <td>
                    <input name="toEmail" readonly type="text" value="<?php echo $result['email']; ?> " class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>From</label>
                </td>
                <td>
                    <input name="fromEmail" type="text" placeholder="Enter your email address" class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Subject</label>
                </td>
                <td>
                    <input name="subject" type="text" placeholder="Enter your subject" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Message </label>
                </td>
                <td>
                    <textarea name="message" class="tinymce">

                    </textarea>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Send" />
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