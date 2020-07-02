<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['edit_id']) || $_GET['edit_id'] == NULL) {
    header('location:postlist.php');
    // echo "<script>window.location='catlist.php';</script>";
} else {
    $getid = $_GET['edit_id'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $category = mysqli_real_escape_string($db->link, $_POST['category']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $userid = mysqli_real_escape_string($db->link, $_POST['userid']);
            //Upload image
            $permited = array('jpg', 'jpeg', 'png', 'gig');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if (
                $title == "" || $category == "" || $body == "" || $author == "" || $tags == "" 
               
            ) {
                echo '<span class="error">Field must not  be empty !</span>';
            }else{
            if (!empty($file_name)) {
               
                if ($file_size > 1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!
        </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-"
                        . implode(', ', $permited) . "</span>";
                } else {
                   
               move_uploaded_file($file_temp, $uploaded_image);

                  $query = "UPDATE post_tbl SET
                  category='$category',
                  title='$title',
                  body='$body',
                  image='$uploaded_image',
                  author='$author',
                  tags='$tags',
                  userid='$userid'
                  WHERE id='$getid'
                 
                  ";

                $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Post updated Successfully.
        </span><a href=postlist.php>Go to Categorylist.</a>";
                    } else {
                        echo "<span class='error'>Post Not updated !</span>";
                    }
            }
        }else{
                $query = "UPDATE post_tbl SET
                  category='$category',
                  title='$title',
                  body='$body',
                  author='$author',
                  tags='$tags',
                   userid='$userid'
                  WHERE id='$getid'
                  ORDER BY id DESC
                  ";

                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Post updated Successfully.
        </span><a href=postlist.php>Go to Postlist</a>";
                } else {
                    echo "<span class='error'>Post Not updated !</span>";
                }
            }
        }
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
                                <input name="title" type="text" value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select name="category" id="select" name="select">
                                    <option>Select Category </option>
                                    <?php
                                    $query = 'SELECT *  FROM category_tbl';
                                    $catagory = $db->select($query);
                                    if ($catagory) {
                                        while ($result = $catagory->fetch_assoc()) {

                                    ?>
                                            <option
                                            <?php if ($postresult['category']==$result['id']){ ?>
                                                selected='selected'
                                            <?php } ?>
                                            value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src=" <?php echo $postresult['image']; ?>" width="200px" height="100px" alt="">
                                <br>
                                <input name="image" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">

                                <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input name="tags" type="text" value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input name="author" type="text" value="<?php echo $postresult['author']; ?>" class="medium" />
                                <input name="userid" type="hidden" value="<?php echo Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } }?>

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