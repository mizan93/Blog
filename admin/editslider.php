<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
if (!isset($_GET['slide_id']) || $_GET['slide_id'] == null) {

    header('location:sliderlist.php');
    // echo "<script>window.location='catlist.php';</script>";
} else {
    $getid = $_GET['slide_id'];
}
?>
<div class="grid_10">

    <div class="box round first grid">

        <h2>Add Slider</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
                //Upload image
            $permited = array('jpg', 'jpeg', 'png', 'gig');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if ($title == "") {
               
                echo '<span class="error">Field must not  be empty !</span>';
            } else {
                if (!empty($file_name)) {

                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!
        </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {

                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "UPDATE slider SET
                   title='$title',
                  image='$uploaded_image'
                  WHERE id='$getid'
                 
                  ";

                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Slider updated Successfully.
        </span><a href=sliderlist.php>Go to Sliderlist.</a>";
                        } else {
                            echo "<span class='error'>Slider Not updated !</span>";
                        }
                    }
                } else {
                    $query = "UPDATE post_tbl SET
                 
                  title='$title'
                  
                  WHERE id='$getid'
                  ";

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Slider updated Successfully.
        </span><a href=sliderlist.php>Go to Sliderlist.</a>";
                    } else {
                        echo "<span class='error'>Slider Not updated !</span>";
                    }
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT  *  FROM slider WHERE id='$getid' ";
            $post = $db->select($query);
            if ($post) {

                while ($result = $post->fetch_assoc()) {


            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input name="title" type="text" value="<?php echo $result['title']; ?>" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src=" <?php echo $result['image']; ?>" width="200px" height="100px" alt="">
                                    <br>
                                    <input name="image" type="file" />
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