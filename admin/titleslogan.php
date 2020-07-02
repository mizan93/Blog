<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    .leftside {
        float: left;
        width: 70%
    }

    .rightside {
        float: left;
        width: 20%
    }
</style>
<?php 
if (Session::get('userRole')!=0) {
    echo "<script>window.location = 'index.php';</script>";

}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $format->validation($_POST['title']);
            $slogan = $format->validation($_POST['title']);

            $title = mysqli_real_escape_string($db->link, $title);
            $slogan = mysqli_real_escape_string($db->link, $slogan);

            //Upload image
            $permited = array('png');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $same_image = 'logo' . '.' . $file_ext;
            $uploaded_image = "upload/" . $same_image;

            if (
                $title == "" || $slogan == ""
            ) {
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

                        $query = "UPDATE  title_slogan SET
                 
                  title='$title',
                  slogan='$slogan',
                  logo='$uploaded_image'
                  
                  WHERE id='1'
                  ";

                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Data updated Successfully.
        </span>";
                        } else {
                            echo "<span class='error'>Post Not updated !</span>";
                        }
                    }
                } else {
                    $query = "UPDATE title_slogan SET
                    title='$title',
                  slogan='$slogan'
                  WHERE id='1'
                  ";

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Data updated Successfully.
        </span>";
                    } else {
                        echo "<span class='error'>Post Not updated !</span>";
                    }
                }
            }
        }
        ?>
        <?php
        $sql = "SELECT * FROM title_slogan WHERE id='1'";
        $title = $db->select($sql);
        if ($title) {
            while ($result = $title->fetch_assoc()) {

        ?>
                <div class="block sloginblock">
                    <div class="leftside">

                        <form action="titleslogan.php" method="post" enctype="multipart/form-data">

                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Website Title</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo  $result['title']; ?>" name="title" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website Slogan</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo  $result['title']; ?>" name="slogan" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Upload Logo</label>
                                    </td>
                                    <td>
                                        <input name="logo" type="file" />
                                    </td>
                                </tr>

                                <tr> 
                                    <td>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                    <div class="rightside">
                        <img src="<?php echo  $result['logo']; ?>" alt="Logo">

                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>
<?php include 'inc/footer.php'; ?>