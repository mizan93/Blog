<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['viewpost_id']) || $_GET['viewpost_id'] == NULL) {
    header('location:postlist.php');
    // echo "<script>window.location='catlist.php';</script>";
} else {
    $getid = $_GET['viewpost_id'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          echo "<script>window.location = 'postlist.php';</script>";
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM post_tbl WHERE id='$getid' ORDER BY id DESC";
            $getpost = $db->select($query);
            if ($getpost) {

                while ($postresult = $getpost->fetch_assoc()) {

            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postresult['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select readonly id="select" name="select">
                                        <option>Select Category </option>
                                        <?php
                                        $query = 'SELECT *  FROM category_tbl';
                                        $catagory = $db->select($query);
                                        if ($catagory) {
                                            while ($result = $catagory->fetch_assoc()) {

                                        ?>
                                                <option <?php if ($postresult['category'] == $result['id']) { ?> selected='selected' <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Image</label>
                                </td>
                                <td>
                                    <img src=" <?php echo $postresult['image']; ?>" width="200px" height="100px" alt="">
                                    <br>

                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea readonly class="tinymce">

                <?php echo $postresult['body']; ?>
                </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input readonly type="text" value="<?php echo $postresult['author']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
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