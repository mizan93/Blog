<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fb = $format->validation($_POST['fb']);
            $tw = $format->validation($_POST['tw']);
            $ln = $format->validation($_POST['ln']);
            $gp = $format->validation($_POST['gp']);

            $fb = mysqli_real_escape_string($db->link, $fb);
            $tw = mysqli_real_escape_string($db->link, $tw);
            $ln = mysqli_real_escape_string($db->link, $ln);
            $gp = mysqli_real_escape_string($db->link, $gp );

            if (
                $fb == "" || $tw == "" || $ln == "" || $gp == "")
             {
                echo '<span class="error">Field must not  be empty !</span>';
            } else{
                $query = "UPDATE  social_tbl SET
                 
                  fb='$fb',
                  tw='$tw',
                  ln='$ln',
                  gp='$gp'
                  
                  WHERE id='1'
                  ";

                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Data updated Successfully.
        </span>";
                } else {
                    echo "<span class='error'>Data Not updated !</span>";
                }
            }
        
        }
?>
        <div class="block">
            <?php
            $sql = "SELECT * FROM social_tbl WHERE id='1' ";
            $social = $db->select($sql);
            if ($social) {
                while ($result = $social->fetch_assoc()) {

            ?>
                    <form action="social.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
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
<?php include 'inc/footer.php'; ?>