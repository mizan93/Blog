<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['page_id']) || $_GET['page_id'] == NULL) {
    header('location:index.php');
    // echo "<script>window.location='catlist.php';</script>";
} else {
    $getid = $_GET['page_id'];
}
?>
<style>
    .action_del {
        margin-left: 10px;

    }

    .action_del a {
        background: #F0F0F0;
        border: 1px solid #ddd;
        color: #4F5A71;
        font-weight: normal;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
    }
</style>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = ($_POST['name']);
            $body = ($_POST['body']);
            $userid = ($_POST['userid']);
            $name = mysqli_real_escape_string($db->link,  $name);
            $body = mysqli_real_escape_string($db->link, $body);
            $userid = mysqli_real_escape_string($db->link, $userid);


            if (
                $name == "" || $body == ""
            ) {
                echo '<span class="error">Field must not  be empty !</span>';
            } else {
                $query = "UPDATE page SET
                     name='$name',
                     body='$body',
                     userid='$userid'
                     WHERE id='$getid' ";
                $updated_page = $db->update($query);
                if ($updated_page) {
                    echo '<span class="success">Data Updated succesfully!</span>';
                } else {
                    echo '<span class="error">Data not Updated !</span>';
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM page WHERE id='$getid'";
            $pages = $db->select($query);
            if ($pages) {

                while ($result = $pages->fetch_assoc()) {

            ?>

                    <form action="" method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>name</label>
                                </td>
                                <td>
                                    <input name="name" type="text" value=" <?php echo $result['name'] ?>" class="medium" />
                                    <input name="userid" type="hidden" value="<?php echo Session::get('pageuser'); ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>body</label>
                                </td>
                                <td>
                                    <textarea name="body" class="tinymce">
                                        <?php echo $result['body']; ?>
                                </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>

                                    <input type="submit" name="submit" Value="Update" />
                                    <?php if (Session::get('userRole') == 0) {
                                    ?>
                                        <span class='action_del'><a onclick="return confirm('Are you sure to delete??');" href="delpage.php?delt_id=
                                    <?php echo $result['id']; ?>">Delete page</a></span>
                                </td>
                            <?php } ?>
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